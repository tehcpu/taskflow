var baseUrl = "http://vk.tehcpu.ru";

function apiRequest(method, data, callback) {
    var apiBase = baseUrl+'/method/';
    var url = apiBase+method;
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: 'json'
    }).done(function( data ) {
        callback(data);
    });
}

function notificationCenter(msg, status) {
    var notyf = new Notyf();
    (status !== 'success') ? notyf.alert(msg) : notyf.confirm(msg);
}

function redirect(url) {
    history.pushState(null, null, baseUrl+"/"+url);
    app(url,null);
}
function timeConverter(t) {
    var a = new Date(t * 1000);
    var today = new Date();
    var yesterday = new Date(Date.now() - 86400000);
    var months = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = padDigits(a.getHours(), 2);
    var min = padDigits(a.getMinutes(), 2);
    if (a.setHours(0,0,0,0) == today.setHours(0,0,0,0))
        return 'сегодня, ' + hour + ':' + min;
    else if (a.setHours(0,0,0,0) == yesterday.setHours(0,0,0,0))
        return 'вчера, ' + hour + ':' + min;
    else if (year == today.getFullYear())
        return date + ' ' + month + ', ' + hour + ':' + min;
    else
        return date + ' ' + month + ' ' + year + ', ' + hour + ':' + min;
}

function getFeed(method, last_id, selector, user_id) {
    window.lock = true;
    apiRequest(method, {'last_id': last_id, 'user_id': user_id}, function (response) {
        console.log(response);
        if (response.hasOwnProperty("response")) {
            if (response.response.tasks.length == 0 || window.list_last_id == 1) window.lock = true;
            for (i = 0; i < response.response.tasks.length; i++) {
                var html = "";
                task = response.response.tasks[i];
                $.each(response.response.profiles, function (i, v) {
                    if (v.id == task.owner_id) {
                        avatar = "http://www.gravatar.com/avatar/" + task.owner_id + "?d=identicon";
                        html += '<div class="job  " id="task_' + task.id + '">' +
                            '<div class="inner">' +
                            "<a class='job_icon' style='background-image: url(" + avatar + ")' href='/profile/" + task.owner_id + "'></a>" +
                            '<span class="date">' + timeConverter(task.created_at) + '</span>' +
                            '<span class="task_salary">' + task.budget + ' &#x20bd;</span>' +
                            '<div class="info">' +
                            '<div class="title" title="' + escapeHTML(task.title) + '">' +
                            '<a href="/task/' + task.id + '">' + escapeHTML(task.title) + '</a>' +
                            '</div>' +
                            '<span class="task_description">' + escapeHTML(task.body) + '</span>' +
                            '<div class="company_name">' +
                            '<a href="/profile/' + task.owner_id + '">' + escapeHTML(v.firstname) + ' ' + escapeHTML(v.lastname) + '</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        return false; // stops the loop
                    }
                });
                $("#"+selector).append(html);
                window.lock = false;
                window.list_last_id = task.id;
            }
            if (window.list_last_id == 0) $("#"+selector).append("<p class='empty_list'>Список пуст</p>");
        } else {
            notificationCenter("Что-то пошло совсем не так :(", 'error')
        }
    })
}

function getTransactions(method, last_id, selector) {
    window.lock = true;
    apiRequest(method, {'last_id': last_id}, function (response) {
        console.log(response);
        if (response.hasOwnProperty("response")) {
            if (response.response.transactions.length == 0 || window.list_last_id == 1) window.lock = true;
            for (i = 0; i < response.response.transactions.length; i++) {
                transaction = response.response.transactions[i];
                type = (transaction.to_id == 0) ? 'spend' : 'obtain';
                msg = (transaction.to_id == 0) ? 'Списание средств за публикацию заказа ' : 'Получение средств за выполнение заказа ';
                sum = (transaction.to_id == 0) ? "-"+transaction.sum : transaction.sum;
                html = '<div class="job" id="transaction_'+transaction.id+'">' +
                        '<div class="inner transactions_inner">' +
                        '<span class="date">'+timeConverter(transaction.created_at)+'</span>' +
                        '<span class="transaction_description">'+msg+' <a href="/task/'+transaction.task_id+'">#'+transaction.task_id+'</a></span>' +
                        '<span class="transaction_price '+type+'">'+sum+' &#x20bd;</span>' +
                        '</div>' +
                        '</div>';
                if (transaction.to_id != 0 && transaction.from_id == window.uid) html = ''; // don't show fake-positive for owner list
                $("#"+selector).append(html);
                window.lock = false;
                window.list_last_id = transaction.id;
            }
            if (window.list_last_id == 0) $("#"+selector).append("<p class='empty_list'>Список пуст</p>");
        } else {
            notificationCenter("Что-то пошло совсем не так :(", 'error')
        }
    })
}

function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}

function balanceUpdater(sum) {
    $("#balanceSum").text(parseInt($("#balanceSum").text())+sum);
}

function lettersOnly() {
    var charCode = event.keyCode;
    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode >= 1040 && charCode <= 1103) || charCode == 8)
        return true;
    else
        return false;
}

var ESC_MAP = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#39;'
};

function escapeHTML(s, forAttribute) {
    if (!s) return s;
    s = s+'';
    return s.replace(forAttribute ? /[&<>'"]/g : /[&<>]/g, function(c) {
        return ESC_MAP[c];
    });
}