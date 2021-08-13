jQuery(function ($) {
  $(document).ready(function () {
    let opened = false;
    $(".header-foot-hamburgerMenu").click(function () {
      if (opened) {
        $(".smHeader").animate({ height: 1 }, 200);
      } else {
        $(".smHeader").animate({ height: 290 }, 200);
      }
      opened = !opened;
      return false;
    });

    $(document).on("click", function (e) {
      if (!$(e.target).closest(".smHeader").length) {
        if (opened) {
          $(".smHeader").animate({ height: 1 }, 200);
          opened = !opened;
        }
      }
    });
  });
});
