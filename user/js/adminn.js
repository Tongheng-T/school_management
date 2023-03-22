$('.line_items td a').click(function () {
    $(this).addClass("active").siblings().removeClass("active");
  });