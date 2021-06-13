"use strict";

$(function () {
  var cartPositionsCount = $('#cart-positions-count');
  $('body').on('click', '.add-to-cart', function (event) {
    event.preventDefault();
    var btn = $(this);
    if (btn.attr('disabled')) {
      return false;
    }
    var productId = btn.data('product_id');

    $.ajax({
      method: 'post',
      url: '/cart/add-to-cart',
      data: {product_id: productId},
      success: function (data, status, jqXHR) {
        if (status === 'success' && jqXHR.status === 201) {
          cartPositionsCount.text(data.count || 0);
          $.pjax.reload({container: '#pjax-products'});
        }
      },
      error: function () {
        alert('Failed to add product to cart');
      }
    });
  });
});