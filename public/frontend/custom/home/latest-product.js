$(document).on('click', '.adminLatestCheckCart', function() {
    let latest_product_id     = $(this).data('itemid');
    let latest_input_name     = 'input[name=latest_number_'+latest_product_id+']';
    let latest_number         = parseInt($(this).closest("div.adminLatestCartForm").find(latest_input_name).val());
    let sell_quantity         = parseInt($('input[name=latest_sell_quantity_'+latest_product_id+']').val());
    let latest_min_stock_qty  = parseInt($('input[name=latest_min_stock_qty_'+latest_product_id+']').val()) | 0;
    let latest_sell_quantity  = sell_quantity - latest_min_stock_qty;  /* if input quantity is greater than minstock quantity */

    let latestInputData       = getLatestInputData(latest_product_id);
    latestInputData.quantity  = 1;

    if (latest_number <= latest_sell_quantity) {/* click plus button and then add to cart */      
    console.log('yes')
        $.ajax({
            url : "/check-cart",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: latest_product_id,
                inputData: latestInputData,
                sell_quantity: latest_sell_quantity,
                min_stock_qty: latest_min_stock_qty
            },
        })
        .done((resp) => {
            appendLatestContent(resp);   /* to append click plus button add to cart data in header */
            if (resp.quantity.status == true) { /* if input quantity is greater than sell quanity */
                $('.adminLatestOutOfStock_'+latest_product_id).removeClass('invisible');
                $('input[name=latest_number_'+latest_product_id+']').val(resp.quantity.quantity);
            } else {
                $('input[name=latest_number_'+latest_product_id+']').val(resp.quantity);
            }
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminLatestOutOfStock_'+latest_product_id).removeClass('invisible');
        $('input[name=latest_number_'+latest_product_id+']').val(latest_sell_quantity);
    }
})

/* multi update cart function with increase and decrease action */
$(document).on('click', '.adminLatestCartUpdate', function() {

    let latest_product_id      = $(this).data('itemid');
    let latest_min_stock_qty   = parseInt($('input[name=latest_min_stock_qty_'+latest_product_id+']').val()) | 0;
    let sell_quantity          = parseInt($('input[name=latest_sell_quantity_'+latest_product_id+']').val());
    let latest_input_name      = 'input[name=latest_number_'+latest_product_id+']';
    let latest_number          = parseInt($(this).closest("div.adminLatestCartForm").find(latest_input_name).val());
    let latest_sell_quantity   = sell_quantity - latest_min_stock_qty; /* if input quantity is greater than minstock quantity */
    
    let latestInputData        = getLatestInputData(latest_product_id);
    latestInputData.quantity   = latest_number;


    if (latest_number <= latest_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: latestInputData,
        })
        .done((resp) => {
            appendLatestContent(resp)
            $('.adminLatestOutOfStock_'+latest_product_id).addClass('invisible');
            $('input[name=latest_number'+latest_product_id+']').val(resp.quantity);
        })
        .fail((e) => console.log(e))
    } else {
        $(this).closest("div.adminLatestCartForm").find(latest_input_name).val(latest_sell_quantity)
        $('.adminLatestOutOfStock_'+latest_product_id).removeClass('invisible');
    }
});

function getLatestInputData(latest_product_id) {

    let latest_product_name    = $('input[name=latest_name_'+latest_product_id+']').val();
    let latest_product_image   = $('input[name=latest_image_'+latest_product_id+']').val();
    let latest_sale_price      = $('input[name=latest_sale_price_'+latest_product_id+']').val();
    let latest_type            = $('input[name=latest_type_'+latest_product_id+']').val();

    return {product_id: latest_product_id, product_name: latest_product_name, product_image: latest_product_image, amount: latest_sale_price, type: latest_type};
}

function appendLatestContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}
