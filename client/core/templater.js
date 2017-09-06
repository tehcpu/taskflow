(function($,window){

    var pageHandlers = {};
    var pageTitles = {"feed": "Задачи", "feedmy": "Мои задачи", "auth": "Авторизация", "register": "Регистрация",
        "task": "Задача", "profile": "Профиль", "new_task": "Новая задача", "settings": "Настройки", "transactions": "Транзакции"};

    var currentPageName = null;
    var $currentPage = null;

    var lock = false;

    function show(pageName,param) {
        var $page = $("section#" + pageName);
        if( $page.length == 0 ) {
            console.warn("section with id=%s not found!",pageName);
            return;
        }
        var ph = pageHandlers[pageName];
        if( ph ) {
            var that = $page.length > 0 ? $page[0] : null;
            var r = ph.call(that , param);
            if( typeof r == "function" ) {
                if(!$page.is("[no-ctl-cache]"))
                    pageHandlers[pageName] = r;
                r.call(that, param);
            }
        }
        if(currentPageName) {
            $(document.body).removeClass(currentPageName);
            if($currentPage) {
                $currentPage.trigger("page.hidden",currentPageName);
                if($currentPage.attr('src') && $currentPage.is("[no-ctl-cache]"))
                    $currentPage.empty();
            }
        }
        $(document.body).addClass(currentPageName = pageName);
        if($currentPage = $page)
            $currentPage.trigger("page.shown",currentPageName);
    }

    function app(pageName,param) {
        var $page = $(document.body).find("section#" + pageName);
        var src = $page.attr("src");
        if ( src && $page.find(">:first-child").length == 0) {
            app.get(src, $page, pageName)
                .done(function(html){$page.html(html); show(pageName,param); })
                .fail(function(){ console.warn("failed to get %s page!",pageName);});
        } else
            show(pageName,param);
    }


    app.page = function(pageName, handler) { pageHandlers[pageName] = handler; };
    app.get = function(src,$page,pageName) { return $.get(src, "html"); };

    function router() {
        invalidateContext();
        setTitle();
        var url = location.pathname.split('/');
        var pageName = url[1];
        var param = url[2];
        app(pageName,param);
    }

    $('body').on('click', 'a', function(event) {
        if (!$(this).hasClass("pseudo")) {
            event.preventDefault();
            event.stopPropagation();
            history.pushState('data to be passed', 'Title of the page', $(this).attr("href"));
            router()
        }
    });

    window.onpopstate = function() {
        lock = true;
        router();
        setTimeout(function () {
            lock = false;
        }, 100)
    };

    function invalidateContext() {
        // menu highligther
        $(".top_main_menu a").removeClass("active");
        $(".top_main_menu a[href='"+location.pathname+"']").addClass("active");

        // null vars
        $(window).unbind('scroll');
        window.list_last_id = 0;

        // clean lists
        $(".content_list").html("");

        // profile special fix
        $(".profile_sidebar").remove();
    }

    function setTitle() {
        titleKey = location.pathname.replace(/[0-9]/g, '');
        titleKey = titleKey.replace(/\//g, "")
        document.title = "Task Flow | "+pageTitles[titleKey];
    }

    window.app = app;
    window.setTimeout( function() { if (!lock) $(router); } );

})(jQuery,this);