/*
 * jQuery Page Scroller 1.0.0
 *
 * Requirements
 * jQuery version 1.7 or higher
 */
(function($) {
    $.fn.extend({
        "pageScroller" : function() {
            var _this = this;
            $(document).on('click', _this.selector, function() {
                var target = $(this).attr('href');
                if(target.match(/^#.+/)) {
                    $('html,body').animate(
                        { scrollTop: $(target).offset().top},
                        {"easing" : "easeOutCubic"}
                    );
                    return false;
                }
            });
            return this;
        }
    });
    $.extend(
        jQuery.easing, {
            "easeOutCubic": function (x, t, b, c, d) {
            return c*((t=t/d-1)*t*t + 1) + b;
        }
    });
})(jQuery);