jQuery(function ($) {
  $(document).ready(function () {
    let aside_toggle = false;
    $(".products-search").on("click", function () {
      if (aside_toggle) {
        $(".products-aside").animate({ left: -258 }, 100);
        $(".cover").animate({ opacity: 0 }, 100, function () {
          $(this).remove();
        });
      } else {
        $(".products").append("<div class='cover'></div>");
        $(".cover").animate({ opacity: 1 }, 100);
        $(".products-aside").animate({ left: 0 }, 100);
      }
      aside_toggle = !aside_toggle;
      return false;
    });

    $(document).on("click", function (e) {
      if (!$(e.target).closest(".products-aside").length) {
        if (aside_toggle) {
          $(".products-aside").animate({ left: -258 }, 100);
          aside_toggle = !aside_toggle;
          $(".cover").animate({ opacity: 0 }, 100, function () {
            $(this).remove();
          });
        }
      }
    });
  });
});
