$(document).on('click', '.adminHotCheckCart', function() {
    let hot_product_id      = $(this).data('itemid');
    let hot_input_name      = 'input[name=hot_number_'+hot_product_id+']';
    let hot_number          = parseInt($(this).closest("div.adminHotCartForm").find(hot_input_name).val());
    let sell_quantity       = parseInt($('input[name=hot_sell_quantity_'+hot_product_id+']').val());
    let hot_min_stock_qty   = parseInt($('input[name=hot_min_stock_qty_'+hot_product_id+']').val()) | 0;
    let hot_sell_quantity   = sell_quantity - hot_min_stock_qty;

    let hotInputData        = getHotInputData(hot_product_id);
    hotInputData.quantity   = 1;

    if (hot_number <= hot_sell_quantity) {  /* click plus button and then add to cart */      
        $.ajax({
            url : "/check-cart",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: hot_product_id,
                inputData: hotInputData,
                sell_quantity: hot_sell_quantity,
                min_stock_qty: hot_min_stock_qty
            },
        })
        .done((resp) => {
            appendHotContent(resp);   /* to append click plus button add to cart data in header */
            if (resp.quantity.status == true) { /* if input quantity is greater than sell quanity */
                $('.adminHotOutOfStock_'+hot_product_id).removeClass('invisible');
                $('.adminMbHotOutOfStock_'+hot_product_id).removeClass('invisible');
                $('input[name=hot_number_'+hot_product_id+']').val(resp.quantity.quantity);
                $('input[name=mb_hot_number_'+hot_product_id+']').val(resp.quantity.quantity); /* for hot seller mobile */
            } else {
                $('input[name=hot_number_'+hot_product_id+']').val(resp.quantity);
                $('input[name=mb_hot_number_'+hot_product_id+']').val(resp.quantity); /* for hot seller mobile */
            }
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminHotOutOfStock_'+hot_product_id).removeClass('invisible');
        $('.adminMbHotOutOfStock_'+hot_product_id).removeClass('invisible');
        $('input[name=hot_number_'+hot_product_id+']').val(hot_sell_quantity);
    }
})

/* multi update cart function with increase and decrease action */
$(document).on('click', '.adminHotCartUpdate', function() {

    let hot_product_id      = $(this).data('itemid');
    let hot_min_stock_qty   = parseInt($('input[name=hot_min_stock_qty_'+hot_product_id+']').val()) | 0;
    let sell_quantity       = parseInt($('input[name=hot_sell_quantity_'+hot_product_id+']').val());
    let hot_input_name      = 'input[name=hot_number_'+hot_product_id+']';
    let hot_number          = parseInt($(this).closest("div.adminHotCartForm").find(hot_input_name).val());
    let hot_sell_quantity   = sell_quantity - hot_min_stock_qty;

    let hotInputData        = getHotInputData(hot_product_id);
    hotInputData.quantity   = hot_number;

    if (hot_number <= hot_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: hotInputData,
        })
        .done((resp) => {
            appendHotContent(resp)
            $('.adminHotOutOfStock_'+hot_product_id).addClass('invisible');
            $('input[name=hot_number_'+hot_product_id+']').val(resp.quantity);
        })
        .fail((e) => console.log(e))
    } else {
        $('input[name=hot_number_'+hot_product_id+']').val(hot_sell_quantity);
        $('.adminHotOutOfStock_'+hot_product_id).removeClass('invisible');
    }
});

function getHotInputData(hot_product_id) {

    let hot_product_name    = $('input[name=hot_name_'+hot_product_id+']').val();
    let hot_product_image   = $('input[name=hot_image_'+hot_product_id+']').val();
    let hot_sale_price      = $('input[name=hot_sale_price_'+hot_product_id+']').val();
    let hot_type            = $('input[name=hot_type_'+hot_product_id+']').val();

    return {product_id: hot_product_id, product_name: hot_product_name, product_image: hot_product_image, amount: hot_sale_price, type: hot_type};
}

function appendHotContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}

/* mobile hot seller add to cart */

$(document).on('click', '.adminMbHotCartUpdate', function() {
    let mb_hot_product_id      = $(this).data('itemid');
    let mb_hot_input_name      = 'input[name=mb_hot_number_'+mb_hot_product_id+']';
    let mb_hot_number          = parseInt($(this).closest("div.adminMbHotCartForm").find(mb_hot_input_name).val());
    let mb_hot_min_stock_qty   = parseInt($('input[name=mb_hot_min_stock_qty_'+mb_hot_product_id+']').val()) | 0;
    let mb_sell_quantity       = parseInt($('input[name=mb_hot_sell_quantity_'+mb_hot_product_id+']').val());
    let mb_hot_sell_quantity   = mb_sell_quantity - mb_hot_min_stock_qty;

    let mbHotInputData         = getMbHotInputData(mb_hot_product_id);
    mbHotInputData.quantity    = mb_hot_number;

    if (mb_hot_number <= mb_hot_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: mbHotInputData,
        })
        .done((resp) => {
            appendMbHotContent(resp);
            $('.adminHotOutOfStock_'+mb_hot_product_id).addClass('invisible');
            $('.adminMbHotOutOfStock_'+mb_hot_product_id).addClass('invisible');
            closeCart();
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminMbHotOutOfStock_'+mb_hot_product_id).removeClass('invisible');
        $('input[name=mb_hot_number_'+mb_hot_product_id+']').val(mb_hot_sell_quantity);
    }
});

function getMbHotInputData(mb_hot_product_id) {

    let mb_hot_product_name    = $('input[name=mb_hot_name_'+mb_hot_product_id+']').val();
    let mb_hot_product_image   = $('input[name=mb_hot_image_'+mb_hot_product_id+']').val();
    let mb_hot_sale_price      = $('input[name=mb_hot_sale_price_'+mb_hot_product_id+']').val();
    let mb_hot_type            = $('input[name=mb_hot_type_'+mb_hot_product_id+']').val();

    return {product_id: mb_hot_product_id, product_name: mb_hot_product_name, product_image: mb_hot_product_image, amount: mb_hot_sale_price, type: mb_hot_type};
}

function appendMbHotContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}