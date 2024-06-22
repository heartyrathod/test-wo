// js/related-products.js
jQuery(document).ready(function($) {
    var productId = product_id; // Replace with dynamic product ID
  
    $.ajax({
        url: related_products_params.ajax_url,
        type: 'POST',
        data: {
            action: 'get_related_products',
            product_id: productId,
        },
        success: function(response) {
            if (response.success) {
                var products = response.data;
                var productsList = '<ul>';
                $.each(products, function(index, product) {
                    productsList += '<li><a href="' + product.link + '">' + product.name + '</a></li>';
                });
                productsList += '</ul>';
                $('#related-products').html(productsList);
            } else {
                $('#related-products').html('<p>' + response.data + '</p>');
            }
        }
    });
  });