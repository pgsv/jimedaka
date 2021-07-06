jQuery(function() {
    jQuery('a[href^="#"]').click(function() {
        console.log('カテゴリークリック');
        var headerHeight = 30;
        var speed = 800;
        var href = jQuery(this).attr("href");
        var target = jQuery(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top - headerHeight;
        jQuery('body,html').animate({
            scrollTop: position
        }, speed, 'swing');
        return false;
    });
});