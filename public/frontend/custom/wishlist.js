$('document').ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    

    $('#adminAddWishList').click(function () {
        var product_id = $(this).data('id');
        let quantity   = 0;
        let price      = parseFloat($(this).data('price'));

        let sell_quantity   = $('input[name=p_detail_sell_quantity_'+product_id+']').val();    
        let min_stock_qty   = $('input[name=p_detail_min_stock_qty_'+product_id+']').val();

        if (sell_quantity != min_stock_qty) {
            quantity   = 1;
        }

        $.ajax({
            method: "POST",
            url: "/get-wishlist",
            data: {
                product_id: product_id,
                quantity: quantity,
                price: price,
            },
            success:function (resp) {
                $('#adminWishlistCount').text(resp.quantity);
            }
        })
    });

    $('.adminWishListCart').click(function () {
        let product_id  = $(this).attr('data-product-id');
        let wishlist_id = $(this).attr('data-wishlist-id');

        let quantity            = $('input[name=wish_list_number_'+wishlist_id+']').val();
        let min_stock_qty       = parseInt($('input[name=wish_list_min_stock_qty_'+product_id+']').val()) | 0;
        let get_sell_quantity   = parseInt($('input[name=wish_list_sell_quantity_'+product_id+']').val());
        let sell_quantity       = get_sell_quantity - min_stock_qty;

        let inputData           = getWishListInputData(product_id, wishlist_id);
        inputData.quantity      = quantity;
        inputData.sell_quantity = sell_quantity;

        if (get_sell_quantity != min_stock_qty) {
            $.ajax({
                url : "/add-wishlist-cart",
                type: 'POST',
                dataType: 'json',
                data: inputData,
            })
            .done((resp) => {
                if (resp.out_of_stock == true) {
                    $('.adminWishlistRow'+wishlist_id).addClass('warning-msg');
                    $('.adminWishListCart').addClass('hidden');
                    $('.adminStatusText').html(`<p class="status out-of-stock">Out Of Stock</p>`);
                } else {
                    $('.adminWishlistRow'+wishlist_id).removeClass('warning-msg');
                }
                appendWishListContent(resp);
                closeCart();
            })
            .fail((e) => console.log(e))
        }
    });

    function getWishListInputData(product_id, wishlist_id) {

        let product_name    = $('input[name=wish_list_name_'+product_id+']').val();
        let product_image   = $('input[name=wish_list_image_'+product_id+']').val();
        let sale_price      = $('input[name=wish_list_sale_price_'+product_id+']').val();
        let type            = $('input[name=wish_list_type_'+product_id+']').val();
    
        return {wishlist_id: wishlist_id, product_id: product_id, product_name: product_name, product_image: product_image, amount: sale_price, type: type};
    }

    function appendWishListContent(resp) {
        $('#adminCartCount').html(resp.total_quantity)
        $('#adminCartItemLabel').html(resp.total_item_label)
        $('#adminTotalAmount').html(resp.total_amount)
        $('.adminCartItemList').html(resp.html)
    }

    $('.adminRemoveWishList').on('click', function () {
        let wishlist_id  = $(this).data('id');

        $('#wishlist-item-id').val(wishlist_id);
        
        $('#wishlist-item-delete-form').submit();
    });

    $('.adminClearWishList').on('click', function () {
        $.ajax({
            url     : '/clear-wishlist-item',
            type    : 'POST',
            dataType: 'json',
            success : function (resp) {
               if (resp.success) {
                location.reload();
               }
            },
            error: function(resp) {
                console.log(resp)
            }
        });
    })
});