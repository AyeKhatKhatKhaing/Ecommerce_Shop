$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $('.adminCheckStock').on('click', function () {
        $('#stockWarning').html('');
        $.ajax({
            url     : '/admin/get-product-list',
            type    : 'GET',
            dataType: 'json',
            success : function (resp) {
                $('.adminAddProductList').html(resp.html);
                $('.adminStockModal').modal('show');
            },
            error: function(resp) {
                console.log(resp)
            }
            
        });
    });

    $('.adminApplyProduct').on('click', function () {
        let quantity            = parseInt($("input[name=product_quantity]").val()) || 0;
        let min_stock_quantity  = parseInt($("input:hidden[name=min_total_quantity]").val()) || 0;
        let product_ids         = $("input:hidden[name=product_ids]").val();

        console.log('qty ', quantity)
        if(quantity > min_stock_quantity) {
            $('#stockWarning').html('<span class="text-danger">Input quantity must not exceed ('+ min_stock_quantity +') quantity.</span>');
        } else if(quantity == 0) {
            $('#stockWarning').html('<span class="text-danger">Please enter quantity.</span>');
        } else {
            $.ajax({
                url     : '/admin/update-quantity',
                type    : 'POST',
                dataType: 'json',
                data    : {
                    quantity : quantity,
                    product_ids: product_ids,
                },
                success : function (resp) {
                    $('.adminStockModal').modal('hide');
                    location.reload();
                },
                error: function(resp) {
                    console.log(resp)
                }
                
            });
        }
    });

    $('.adminCloseStockModal').on('click', function () {
        $('.adminStockModal').modal('hide');
    });

    $('.adminCheckQuantity').on('click', function () { /* product quantity 0 */
        $.ajax({
            url     : '/admin/get-product-quantity-list',
            type    : 'GET',
            dataType: 'json',
            success : function (resp) {
                $('.adminProductList').html(resp.html);
                $('.adminQuantityModal').modal('show');
            },
            error: function(resp) {
                console.log(resp)
            }
            
        });
    });

    $('.adminCloseQuantityModal').on('click', function () {
        $('.adminQuantityModal').modal('hide');
    });
});