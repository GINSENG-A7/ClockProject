"use strict";

jQuery(document).ready(function ($) {
  $(".from").submit(function () {
    var str = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "http://clockproject/contact.php",
      data: str,
      success: function success(msg) {
        if (msg == 'OK') {
          result = '<p>Ваш заказ принят</p>';
          $(".fields").hide();
        } else {
          result = msg;
        }

        $('.note').html(result);
      }
    });
    return false;
  });
});