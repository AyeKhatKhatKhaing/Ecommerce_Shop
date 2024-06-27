$(document).on('click', '.adminInterProductCheckCart', function() {
    let inter_product_id              = $(this).data('itemid');
    let inter_product_input_name      ='input[name=inter_product_number_'+inter_product_id+']';
    let inter_product_number          = parseInt($(this).closest("div.adminInterProductCartForm").find(inter_product_input_name).val());
    let sell_quantity                 = parseInt($('input[name=inter_product_sell_quantity_'+inter_product_id+']').val());
    let inter_product_min_stock_qty   = parseInt($('input[name=inter_product_min_stock_qty_'+inter_product_id+']').val()) | 0;
    let inter_product_sell_quantity   = sell_quantity - inter_product_min_stock_qty;

    let inter_product_inputData       = getInterProductInputData(inter_product_id);
    inter_product_inputData.quantity  = 1;

    if (inter_product_number <= inter_product_sell_quantity) {  /* click plus button and then add to cart */      
        $.ajax({
            url : "/check-cart",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: inter_product_id,
                inputData: inter_product_inputData,
                sell_quantity: inter_product_sell_quantity,
                min_stock_qty: inter_product_min_stock_qty
            },
        })
        .done((resp) => {
            appendInterProductContent(resp);   /* to append click plus button add to cart data in header */
            if (resp.quantity.status == true) { /* if input quantity is greater than sell quanity */
            console.log(resp.quantity.quantity)
                $('.adminInterProductOutOfStock_'+inter_product_id).removeClass('invisible');
                $('.adminMbInterProductOutOfStock_'+inter_product_id).removeClass('invisible');
                $('input[name=inter_product_number_'+inter_product_id+']').val(resp.quantity.quantity);
                $('input[name=mb_inter_product_number_'+inter_product_id+']').val(resp.quantity.quantity);
            } else {
                $('input[name=inter_product_number_'+inter_product_id+']').val(resp.quantity);
                $('input[name=mb_inter_product_number_'+inter_product_id+']').val(resp.quantity);
            }
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminInterProductOutOfStock_'+inter_product_id).removeClass('invisible');
        $('.adminMbInterProductOutOfStock_'+inter_product_id).removeClass('invisible');
        $('input[name=inter_product_number_'+inter_product_id+']').val(inter_product_sell_quantity);
    }
})

/* multi update cart function with increase and decrease action */
$(document).on('click', '.adminInterProductCartUpdate', function() {

    let inter_product_id              = $(this).data('itemid');
    let inter_product_min_stock_qty   = parseInt($('input[name=inter_product_min_stock_qty_'+inter_product_id+']').val()) | 0;
    let sell_quantity                 = parseInt($('input[name=inter_product_sell_quantity_'+inter_product_id+']').val());
    let inter_product_input_name      = 'input[name=inter_product_number_'+inter_product_id+']';
    let inter_product_number          = parseInt($(this).closest("div.adminInterProductCartForm").find(inter_product_input_name).val());
    let inter_product_sell_quantity   = sell_quantity - inter_product_min_stock_qty;

    let inter_product_inputData       = getInterProductInputData(inter_product_id);
    inter_product_inputData.quantity  = inter_product_number;

    if (inter_product_number <= inter_product_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: inter_product_inputData,
        })
        .done((resp) => {
            appendInterProductContent(resp)
            $('.adminInterProductOutOfStock_'+inter_product_id).addClass('invisible');
            $('.adminMbInterProductOutOfStock_'+inter_product_id).addClass('invisible');
            $('input[name=inter_product_number_'+inter_product_id+']').val(resp.quantity);
        })
        .fail((e) => console.log(e))
    } else {
        $('input[name=inter_product_number_'+inter_product_id+']').val(inter_product_sell_quantity);
        $('.adminInterProductOutOfStock_'+inter_product_id).removeClass('invisible');
    }
});

function getInterProductInputData(inter_product_id) {

    let inter_product_name        = $('input[name=mb_inter_product_name_'+inter_product_id+']').val();
    let inter_product_image       = $('input[name=mb_inter_product_image_'+inter_product_id+']').val();
    let inter_product_sale_price  = $('input[name=mb_inter_product_sale_price_'+inter_product_id+']').val();
    let inter_product_type        = $('input[name=mb_inter_product_type_'+inter_product_id+']').val();

    return {product_id: inter_product_id, product_name: inter_product_name, product_image: inter_product_image, amount: inter_product_sale_price, type: inter_product_type};
}

function appendInterProductContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}

$(document).on('click', '.adminMbInterProductCartUpdate', function() {
    let mb_inter_product_id              = $(this).data('itemid');
    let mb_inter_product_input_name      = 'input[name=mb_inter_product_number_'+mb_inter_product_id+']';
    let mb_inter_product_number          = parseInt($(this).closest("div.adminMbInterProductCartForm").find(mb_inter_product_input_name).val());
    let mb_inter_product_min_stock_qty   = parseInt($('input[name=mb_inter_product_min_stock_qty_'+mb_inter_product_id+']').val()) | 0;
    let mb_sell_quantity                 = parseInt($('input[name=mb_inter_product_sell_quantity_'+mb_inter_product_id+']').val());
    let mb_inter_product_sell_quantity   = mb_sell_quantity - mb_inter_product_min_stock_qty;

    let mb_inter_productinputData        = getMbInterProductInputData(mb_inter_product_id);
    mb_inter_productinputData.quantity   = mb_inter_product_number;

    if (mb_inter_product_number <= mb_inter_product_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: mb_inter_productinputData,
        })
        .done((resp) => {
            appendMbInterProductContent(resp);
            $('.adminInterProductOutOfStock_'+mb_inter_product_id).addClass('invisible');
            $('.adminMbInterProductOutOfStock_'+mb_inter_product_id).addClass('invisible');
            closeCart();
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminMbInterProductOutOfStock_'+mb_inter_product_id).removeClass('invisible');
        $('input[name=mb_inter_product_number_'+mb_inter_product_id+']').val(mb_inter_product_sell_quantity);
    }
});

function getMbInterProductInputData(mb_inter_product_id) {

    let mb_inter_product_name        = $('input[name=mb_inter_product_name_'+mb_inter_product_id+']').val();
    let mb_inter_product_image       = $('input[name=mb_inter_product_image_'+mb_inter_product_id+']').val();
    let mb_inter_product_sale_price  = $('input[name=mb_inter_product_sale_price_'+mb_inter_product_id+']').val();
    let mb_inter_product_type        = $('input[name=mb_inter_product_type_'+mb_inter_product_id+']').val();

    return {product_id: mb_inter_product_id, product_name: mb_inter_product_name, product_image: mb_inter_product_image, amount: mb_inter_product_sale_price, type: mb_inter_product_type};
}

function appendMbInterProductContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}
