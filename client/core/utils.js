function apiRequest(method, data) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("demo").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "http://taskflow.net/method/accounts.login?login=package&password=123qwe", true);
    xhttp.send();
}