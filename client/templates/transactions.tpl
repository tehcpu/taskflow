<div class="settings_content">
    <div class="settings_sidebar left">
        <div class="section user_settings_menu_profile">
            <div class="menu">
                <a class="active" href="/transactions">Транзакции</a>
            </div>
        </div>
    </div>
    <div class="settings_main right">
        <div class="section">
            <div class="head">
                <div class="title">Транзакции</div>
            </div>
            <div class="body">
                <div class="jobs show_marked" id="jobs_list">
                    <div class="job  " id="job_101">
                        <div class="inner transactions_inner">
                            <span class="date">29 августа 2017</span>
                            <span style="position: absolute; top: -10px; left: 100px; margin-top: 40px">Пополнение счета за выполнение заказа <a href="/task/1">#1</a></span>
                            <span style="position: absolute; top: 30px; left: 20px; color: red">-1337 &#x20bd;</span>
                        </div>
                    </div>
                    <div class="job  " id="job_101">
                        <div class="inner transactions_inner">
                            <span class="date">29 августа 2017</span>
                            <span style="position: absolute; top: -10px; left: 100px; margin-top: 40px">Снятие со счета для оплаты заказа <a href="/task/1">#1</a></span>
                            <span style="position: absolute; top: 30px; left: 20px; color: #68c07b">+1337 &#x20bd;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<script>
    app.page("transactions", function() {
        $(".top_main_menu a").removeClass("active");
        $(".top_main_menu a[href='/settings']").addClass("active");
    });
</script>

<script src="/controllers/transactions.js"></script>