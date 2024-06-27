$(document).on('click', '.adminLikeCheckCart', function() {
    let like_product_id      = $(this).data('itemid');
    let like_input_name      = 'input[name=like_product_number_'+like_product_id+']';
    let like_number          = parseInt($(this).closest("div.adminLikeCartForm").find(like_input_name).val());
    let sell_quantity        = parseInt($('input[name=like_product_sell_quantity_'+like_product_id+']').val());
    let like_min_stock_qty   = parseInt($('input[name=like_product_min_stock_qty_'+like_product_id+']').val()) | 0;
    let like_sell_quantity   = sell_quantity - like_min_stock_qty;

    let likeInputData        = getLikeProductInputData(like_product_id);
    likeInputData.quantity   = 1;

    if (like_number <= like_sell_quantity) {  /* click plus button and then add to cart */      
        $.ajax({
            url : "/check-cart",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: like_product_id,
                inputData: likeInputData,
                sell_quantity: like_sell_quantity,
                min_stock_qty: like_min_stock_qty
            },
        })
        .done((resp) => {
            appendLikeProductContent(resp);   /* to append click plus button add to cart data in header */
            if (resp.quantity.status == true) { /* if input quantity is greater than sell quanity */
                $('.adminLikeOutOfStock_'+like_product_id).removeClass('invisible');
                $('.adminMbLikeOutOfStock_'+like_product_id).removeClass('invisible');
                $('input[name=like_product_number_'+like_product_id+']').val(resp.quantity.quantity);
                $('input[name=mb_like_product_number_'+like_product_id+']').val(resp.quantity.quantity);
            } else {
                $('input[name=like_product_number_'+like_product_id+']').val(resp.quantity);
                $('input[name=mb_like_product_number_'+like_product_id+']').val(resp.quantity);
            }
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminLikeOutOfStock_'+like_product_id).removeClass('invisible');
        $('.adminMbLikeOutOfStock_'+like_product_id).removeClass('invisible');
        $('input[name=like_product_number_'+like_product_id+']').val(like_sell_quantity);
    }
})

/* multi update cart function with increase and decrease action */
$(document).on('click', '.adminLikeCartUpdate', function() {

    let like_product_id      = $(this).data('itemid');
    let like_min_stock_qty   = parseInt($('input[name=like_product_min_stock_qty_'+like_product_id+']').val()) | 0;
    let sell_quantity        = parseInt($('input[name=like_product_sell_quantity_'+like_product_id+']').val());
    let like_input_name      = 'input[name=like_product_number_'+like_product_id+']';
    let like_number          = parseInt($(this).closest("div.adminLikeCartForm").find(like_input_name).val());
    let like_sell_quantity   = sell_quantity - like_min_stock_qty;

    let likeInputData       = getLikeProductInputData(like_product_id);
    likeInputData.quantity  = like_number;

    if (like_number <= like_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: likeInputData,
        })
        .done((resp) => {
            appendLikeProductContent(resp)
            $('.adminLikeOutOfStock_'+like_product_id).addClass('invisible');
            $('.adminMbLikeOutOfStock_'+like_product_id).addClass('invisible');
            $('input[name=like_number_'+like_product_id+']').val(resp.quantity);
        })
        .fail((e) => console.log(e))
    } else {
        $(this).closest("div.adminLikeCartForm").find(like_input_name).val(like_sell_quantity);
        $('.adminLikeOutOfStock_'+like_product_id).removeClass('invisible');
    }
});

function getLikeProductInputData(like_product_id) {

    let like_product_name    = $('input[name=like_product_name_'+like_product_id+']').val();
    let like_product_image   = $('input[name=like_product_image_'+like_product_id+']').val();
    let like_sale_price      = $('input[name=like_product_sale_price_'+like_product_id+']').val();
    let like_type            = $('input[name=like_product_type_'+like_product_id+']').val();

    return {product_id: like_product_id, product_name: like_product_name, product_image: like_product_image, amount: like_sale_price, type: like_type};
}

function appendLikeProductContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}

$(document).on('click', '.adminMbLikeCartUpdate', function() {
    let mb_product_id      = $(this).data('itemid');
    let mb_input_name      = 'input[name=mb_like_product_number_'+mb_product_id+']';
    let mb_number          = parseInt($(this).closest("div.adminMbLikeCartForm").find(mb_input_name).val());
    let mb_min_stock_qty   = parseInt($('input[name=mb_like_product_min_stock_qty_'+mb_product_id+']').val()) | 0;
    let sell_quantity      = parseInt($('input[name=mb_like_product_sell_quantity_'+mb_product_id+']').val());
    let mb_sell_quantity   = sell_quantity - mb_min_stock_qty;

    let mbInputData        = getMbLikeProductInputData(mb_product_id);
    mbInputData.quantity   = mb_number;

    if (mb_number <= mb_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: mbInputData,
        })
        .done((resp) => {
            appendMbLikeProductContent(resp);
            $('.adminLikeOutOfStock_'+mb_product_id).addClass('invisible');
            $('.adminMbLikeOutOfStock_'+mb_product_id).addClass('invisible');
            closeCart();
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminMbLikeOutOfStock_'+mb_product_id).removeClass('invisible');
        $('input[name=mb_like_product_number_'+mb_product_id+']').val(mb_sell_quantity);
    }
});

function getMbLikeProductInputData(mb_product_id) {

    let mb_like_product_name    = $('input[name=mb_like_product_name_'+mb_product_id+']').val();
    let mb_like_product_image   = $('input[name=mb_like_product_image_'+mb_product_id+']').val();
    let mb_like_sale_price      = $('input[name=mb_like_product_sale_price_'+mb_product_id+']').val();
    let mb_like_type            = $('input[name=mb_like_product_type_'+mb_product_id+']').val();

    return {product_id: mb_product_id, product_name: mb_like_product_name, product_image: mb_like_product_image, amount: mb_like_sale_price, type: mb_like_type};
}

function appendMbLikeProductContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}

