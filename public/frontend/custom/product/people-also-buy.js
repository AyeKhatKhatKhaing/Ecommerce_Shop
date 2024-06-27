$(document).on('click', '.adminBuyCheckCart', function() {
    let buy_product_id      = $(this).data('itemid');
    let buy_input_name      ='input[name=buy_product_number_'+buy_product_id+']';
    let buy_number          = parseInt($(this).closest("div.adminBuyCartForm").find(buy_input_name).val());
    let sell_quantity       = parseInt($('input[name=buy_product_sell_quantity_'+buy_product_id+']').val()) | 0;
    let buy_min_stock_qty   = parseInt($('input[name=buy_product_min_stock_qty_'+buy_product_id+']').val());
    let buy_sell_quantity   = sell_quantity - buy_min_stock_qty;

    let buyInputData        = getBuyProductInputData(buy_product_id);
    buyInputData.quantity   = 1;

    if (buy_number <= buy_sell_quantity) {  /* click plus button and then add to cart */      
        $.ajax({
            url : "/check-cart",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: buy_product_id,
                inputData: buyInputData,
                sell_quantity: buy_sell_quantity,
                min_stock_qty: buy_min_stock_qty
            },
        })
        .done((resp) => {
            appendBuyProductContent(resp);   /* to append click plus button add to cart data in header */
            if (resp.quantity.status == true) { /* if input quantity is greater than sell quanity */
                $('.adminBuyOutOfStock_'+buy_product_id).removeClass('invisible');
                $('.adminMbBuyOutOfStock_'+buy_product_id).removeClass('invisible');
                $('input[name=buy_product_number_'+buy_product_id+']').val(resp.quantity.quantity);
                $('input[name=mb_buy_product_number_'+buy_product_id+']').val(resp.quantity.quantity);
            } else {
                $('input[name=buy_product_number_'+buy_product_id+']').val(resp.quantity);
                $('input[name=mb_buy_product_number_'+buy_product_id+']').val(resp.quantity);
            }
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminBuyOutOfStock_'+buy_product_id).removeClass('invisible');
        $('.adminMbBuyOutOfStock_'+buy_product_id).removeClass('invisible');
        $('input[name=buy_product_number_'+buy_product_id+']').val(buy_sell_quantity);
    }
})

/* multi update cart function with increase and decrease action */
$(document).on('click', '.adminBuyCartUpdate', function() {

    let buy_product_id              = $(this).data('itemid');
    let buy_product_min_stock_qty   = parseInt($('input[name=buy_product_min_stock_qty_'+buy_product_id+']').val()) | 0;
    let sell_quantity               = parseInt($('input[name=buy_product_sell_quantity_'+buy_product_id+']').val());
    let buy_product_input_name      = 'input[name=buy_product_number_'+buy_product_id+']';
    let buy_product_number          = parseInt($(this).closest("div.adminBuyCartForm").find(buy_product_input_name).val());
    let buy_product_sell_quantity   = sell_quantity - buy_product_min_stock_qty;

    let buyInputData                = getBuyProductInputData(buy_product_id);
    buyInputData.quantity           = buy_product_number;

    if (buy_product_number <= buy_product_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: buyInputData,
        })
        .done((resp) => {
            appendBuyProductContent(resp)
            $('.adminBuyOutOfStock_'+buy_product_id).addClass('invisible');
            $('input[name=buy_product_number_'+buy_product_id+']').val(resp.quantity);
        })
        .fail((e) => console.log(e))
    } else {
        $('input[name=buy_product_number_'+buy_product_id+']').val(buy_product_sell_quantity);
        $('.adminBuyOutOfStock_'+buy_product_id).removeClass('invisible');
    }
});

function getBuyProductInputData(buy_product_id) {

    let buy_product_name    = $('input[name=buy_product_name_'+buy_product_id+']').val();
    let buy_product_image   = $('input[name=buy_product_image_'+buy_product_id+']').val();
    let buy_sale_price      = $('input[name=buy_product_sale_price_'+buy_product_id+']').val();
    let buy_type            = $('input[name=buy_product_type_'+buy_product_id+']').val();

    return {product_id: buy_product_id, product_name: buy_product_name, product_image: buy_product_image, amount: buy_sale_price, type: buy_type};
}

function appendBuyProductContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}

$(document).on('click', '.adminMbBuyCartUpdate', function() {
    let mb_buy_product_id      = $(this).data('itemid');
    let mb_buy_input_name      = 'input[name=mb_buy_product_number_'+mb_buy_product_id+']';
    let mb_buy_number          = parseInt($(this).closest("div.adminMbBuyCartForm").find(mb_buy_input_name).val());
    let mb_buy_min_stock_qty   = parseInt($('input[name=mb_buy_product_min_stock_qty_'+mb_buy_product_id+']').val()) | 0;
    let sell_quantity          = parseInt($('input[name=mb_buy_product_sell_quantity_'+mb_buy_product_id+']').val());
    let mb_buy_sell_quantity   = sell_quantity - mb_buy_min_stock_qty;

    let mbBuyInputData         = getMbBuyInputData(mb_buy_product_id);
    mbBuyInputData.quantity    = mb_buy_number;

    if (mb_buy_number <= mb_buy_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: mbBuyInputData,
        })
        .done((resp) => {
            appendMbBuyContent(resp);
            $('.adminBuyOutOfStock_'+mb_buy_product_id).addClass('invisible');
            $('.adminMbBuyOutOfStock_'+mb_buy_product_id).addClass('invisible');
            closeCart();
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminMbBuyOutOfStock_'+mb_buy_product_id).removeClass('invisible');
        $('input[name=mb_buy_product_number_'+mb_buy_product_id+']').val(mb_buy_sell_quantity);
    }
});

function getMbBuyInputData(mb_buy_product_id) {

    let mb_buy_product_name    = $('input[name=mb_buy_product_name_'+mb_buy_product_id+']').val();
    let mb_buy_product_image   = $('input[name=mb_buy_product_image_'+mb_buy_product_id+']').val();
    let mb_buy_sale_price      = $('input[name=mb_buy_product_sale_price_'+mb_buy_product_id+']').val();
    let mb_buy_type            = $('input[name=mb_buy_product_type_'+mb_buy_product_id+']').val();

    return {product_id: mb_buy_product_id, product_name: mb_buy_product_name, product_image: mb_buy_product_image, amount: mb_buy_sale_price, type: mb_buy_type};
}

function appendMbBuyContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}