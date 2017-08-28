(function($,window){

    var pageHandlers = {};

    var currentPageName = null;
    var $currentPage = null;

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
        if( src && $page.find(">:first-child").length == 0) {
            app.get(src, $page, pageName)
                .done(function(html){$page.html(html); show(pageName,param); })
                .fail(function(){ console.warn("failed to get %s page!",pageName);});
        } else
            show(pageName,param);
    }


    app.page = function(pageName, handler) { pageHandlers[pageName] = handler; };
    app.get = function(src,$page,pageName) { return $.get(src, "html"); };

    function onhashchange()
    {
        var hash = location.hash || ("#" + $("section[default]").attr('id'));

        var re = /#([-0-9A-Za-z]+)(\:(.+))?/;
        var match = re.exec(hash);
        hash = match[1];
        var param = match[3];
        app(hash,param);
    }

    $(window).on("hashchange", onhashchange );

    window.app = app;
    window.setTimeout( function() { $(onhashchange); } );

})(jQuery,this);