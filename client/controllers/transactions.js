app.page("transactions", function() {
    $(".top_main_menu a[href='/settings']").addClass("active");
    getTransactions("settings.transactions", window.list_last_id, "transactions_list");
    window.scrollTo(500, 0);
    $(window).scroll(function () {
        if (!window.lock) {
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
                getTransactions("settings.transactions", window.list_last_id, "transactions_list");
            }
        }
    });
});