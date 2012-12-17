(function($){
    //拓展jQuery对象验证字符串
    $.validDate = function(date, options)
    {
        var defaults = {
            "pattern" : /^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}$/
        },

        opts = $.extend(defaults, options);

        return date.match(opts.pattern)!=null;
    };
})(jQuery);
