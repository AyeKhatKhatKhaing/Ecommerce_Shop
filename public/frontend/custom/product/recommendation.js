$(document).on('click', '.adminRecomCheckCart', function() {
    let recom_product_id      = $(this).data('itemid');
    let recom_input_name      ='input[name=recom_product_number_'+recom_product_id+']';
    let recom_number          = parseInt($(this).closest("div.adminRecomCartForm").find(recom_input_name).val());
    let sell_quantity         = parseInt($('input[name=recom_product_sell_quantity_'+recom_product_id+']').val());
    let recom_min_stock_qty   = parseInt($('input[name=recom_product_min_stock_qty_'+recom_product_id+']').val()) | 0;
    let recom_sell_quantity   = sell_quantity - recom_min_stock_qty;

    let recomInputData        = getRecomInputData(recom_product_id);
    recomInputData.quantity   = 1;

    if (recom_number <= recom_sell_quantity) {  /* click plus button and then add to cart */      
        $.ajax({
            url : "/check-cart",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: recom_product_id,
                inputData: recomInputData,
                sell_quantity: recom_sell_quantity,
                min_stock_qty: recom_min_stock_qty
            },
        })
        .done((resp) => {
            appendRecomContent(resp);   /* to append click plus button add to cart data in header */
            if (resp.quantity.status == true) { /* if input quantity is greater than sell quanity */
                $('.adminRecomOutOfStock_'+recom_product_id).removeClass('invisible');
                $('.adminMbRecomOutOfStock_'+recom_product_id).removeClass('invisible');
                $('input[name=recom_product_number_'+recom_product_id+']').val(resp.quantity.quantity);
                $('input[name=mb_recom_product_number_'+recom_product_id+']').val(resp.quantity.quantity);
            } else {
                $('input[name=recom_product_number_'+recom_product_id+']').val(resp.quantity);
                $('input[name=mb_recom_product_number_'+recom_product_id+']').val(resp.quantity);
            }
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminRecomOutOfStock_'+recom_product_id).removeClass('invisible');
        $('.adminMbRecomOutOfStock_'+recom_product_id).removeClass('invisible');
        $('input[name=recom_product_number_'+recom_product_id+']').val(recom_sell_quantity);
    }
})

/* multi update cart function with increase and decrease action */
$(document).on('click', '.adminRecomCartUpdate', function() {

    let recom_product_id      = $(this).data('itemid');
    let recom_min_stock_qty   = parseInt($('input[name=recom_product_min_stock_qty_'+recom_product_id+']').val()) | 0;
    let sell_quantity         = $('input[name=recom_product_sell_quantity_'+recom_product_id+']').val();
    let recom_input_name      = 'input[name=recom_product_number_'+recom_product_id+']';
    let recom_number          = parseInt($(this).closest("div.adminRecomCartForm").find(recom_input_name).val());
    let recom_sell_quantity   = sell_quantity - recom_min_stock_qty;

    let recomInputData       = getRecomInputData(recom_product_id);
    recomInputData.quantity  = recom_number;


    if (recom_number <= recom_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: recomInputData,
        })
        .done((resp) => {
            appendRecomContent(resp)
            $('.adminRecomOutOfStock_'+recom_product_id).addClass('invisible');
            $('.adminMbRecomOutOfStock_'+recom_product_id).addClass('invisible');
            $('input[name=recom_product_number_'+recom_product_id+']').val(resp.quantity);
        })
        .fail((e) => console.log(e))
    } else {
        $('input[name=recom_product_number_'+recom_product_id+']').val(recom_sell_quantity);
        $('.adminRecomOutOfStock_'+recom_product_id).removeClass('invisible');
    }
});

function getRecomInputData(recom_product_id) {

    let recom_product_name    = $('input[name=recom_product_name_'+recom_product_id+']').val();
    let recom_product_image   = $('input[name=recom_product_image_'+recom_product_id+']').val();
    let recom_sale_price      = $('input[name=recom_product_sale_price_'+recom_product_id+']').val();
    let recom_type            = $('input[name=recom_product_type_'+recom_product_id+']').val();

    return {product_id: recom_product_id, product_name: recom_product_name, product_image: recom_product_image, amount: recom_sale_price, type: recom_type};
}

function appendRecomContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}

$(document).on('click', '.adminMbRecomCartUpdate', function() {
    let mb_product_id      = $(this).data('itemid');
    let mb_input_name      = 'input[name=mb_recom_product_number_'+mb_product_id+']';
    let mb_number          = parseInt($(this).closest("div.adminMbRecomCartForm").find(mb_input_name).val());
    let mb_min_stock_qty   = parseInt($('input[name=mb_recom_product_min_stock_qty_'+mb_product_id+']').val()) | 0;
    let sell_quantity      = parseInt($('input[name=mb_recom_product_sell_quantity_'+mb_product_id+']').val());
    let mb_sell_quantity   = sell_quantity - mb_min_stock_qty;

    let mbRecominputData       = getMbRecomInputData(mb_product_id);
    mbRecominputData.quantity  = mb_number;

    if (mb_number <= mb_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: mbRecominputData,
        })
        .done((resp) => {
            appendMbRecomContent(resp);
            $('.adminRecomOutOfStock_'+mb_product_id).addClass('invisible');
            $('.adminMbRecomOutOfStock_'+mb_product_id).addClass('invisible');
            closeCart();
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminMbRecomOutOfStock_'+mb_product_id).removeClass('invisible');
        $('input[name=mb_recom_product_number_'+mb_product_id+']').val(mb_sell_quantity);
    }
});

function getMbRecomInputData(mb_product_id) {

    let mb_recom_product_name    = $('input[name=mb_recom_product_name_'+mb_product_id+']').val();
    let mb_recom_product_image   = $('input[name=mb_recom_product_image_'+mb_product_id+']').val();
    let mb_recom_sale_price      = $('input[name=mb_recom_product_sale_price_'+mb_product_id+']').val();
    let mb_recom_type            = $('input[name=mb_recom_product_type_'+mb_product_id+']').val();

    return {product_id: mb_product_id, product_name: mb_recom_product_name, product_image: mb_recom_product_image, amount: mb_recom_sale_price, type: mb_recom_type};
}

function appendMbRecomContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}