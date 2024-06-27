$(document).on('click', '.adminDisProductCheckCart', function() {
    let dis_product_id              = $(this).data('itemid');
    let dis_product_input_name      ='input[name=dis_product_number_'+dis_product_id+']';
    let dis_product_number          = parseInt($(this).closest("div.adminDisProductCartForm").find(dis_product_input_name).val());
    let sell_quantity               = parseInt($('input[name=dis_product_sell_quantity_'+dis_product_id+']').val());
    let dis_product_min_stock_qty   = parseInt($('input[name=dis_product_min_stock_qty_'+dis_product_id+']').val()) | 0;
    let dis_product_sell_quantity   = sell_quantity - dis_product_min_stock_qty;

    let dis_product_inputData       = getDisProductInputData(dis_product_id);
    dis_product_inputData.quantity  = 1;

    if (dis_product_number <= dis_product_sell_quantity) {  /* click plus button and then add to cart */      
        $.ajax({
            url : "/check-cart",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: dis_product_id,
                inputData: dis_product_inputData,
                sell_quantity: dis_product_sell_quantity,
                min_stock_qty: dis_product_min_stock_qty
            },
        })
        .done((resp) => {
            appendDisProductContent(resp);   /* to append click plus button add to cart data in header */
            if (resp.quantity.status == true) { /* if input quantity is greater than sell quanity */
                $('.adminDisProductOutOfStock_'+dis_product_id).removeClass('invisible');
                $('.adminMbDisProductOutOfStock_'+dis_product_id).removeClass('invisible');
                $('input[name=dis_product_number_'+dis_product_id+']').val(resp.quantity.quantity);
                $('input[name=mb_dis_product_number_'+dis_product_id+']').val(resp.quantity.quantity);
            } else {
                $('input[name=dis_product_number_'+dis_product_id+']').val(resp.quantity);
                $('input[name=mb_dis_product_number_'+dis_product_id+']').val(resp.quantity);
            }
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminDisProductOutOfStock_'+dis_product_id).removeClass('invisible');
        $('.adminMbDisProductOutOfStock_'+dis_product_id).removeClass('invisible');
        $('input[name=dis_product_number_'+dis_product_id+']').val(dis_product_sell_quantity);
    }
})

/* multi update cart function with increase and decrease action */
$(document).on('click', '.adminDisProductCartUpdate', function() {

    let dis_product_id              = $(this).data('itemid');
    let dis_product_min_stock_qty   = parseInt($('input[name=dis_product_min_stock_qty_'+dis_product_id+']').val()) | 0;
    let sell_quantity               = parseInt($('input[name=dis_product_sell_quantity_'+dis_product_id+']').val());
    let dis_product_input_name      = 'input[name=dis_product_number_'+dis_product_id+']';
    let dis_product_number          = parseInt($(this).closest("div.adminDisProductCartForm").find(dis_product_input_name).val());
    let dis_product_sell_quantity   = sell_quantity - dis_product_min_stock_qty;

    let dis_product_inputData       = getDisProductInputData(dis_product_id);
    dis_product_inputData.quantity  = dis_product_number;

    if (dis_product_number <= dis_product_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: dis_product_inputData,
        })
        .done((resp) => {
            appendDisProductContent(resp)
            $('.adminDisProductOutOfStock_'+dis_product_id).addClass('invisible');
            $('input[name=dis_product_number_'+dis_product_id+']').val(resp.quantity);
        })
        .fail((e) => console.log(e))
    } else {
        $('input[name=dis_product_number_'+dis_product_id+']').val(dis_product_sell_quantity);
        $('.adminDisProductOutOfStock_'+dis_product_id).removeClass('invisible');
    }
});

function getDisProductInputData(dis_product_id) {

    let dis_product_name         = $('input[name=dis_product_name_'+dis_product_id+']').val();
    let dis_product_image        = $('input[name=dis_product_image_'+dis_product_id+']').val();
    let dis_product_sale_price   = $('input[name=dis_product_sale_price_'+dis_product_id+']').val();
    let dis_product_type         = $('input[name=dis_product_type_'+dis_product_id+']').val();

    return {product_id: dis_product_id, product_name: dis_product_name, product_image: dis_product_image, amount: dis_product_sale_price, type: dis_product_type};
}

function appendDisProductContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}


$(document).on('click', '.adminMbDisProductCartUpdate', function() {
    let mb_dis_product_id              = $(this).data('itemid');
    let mb_dis_input_name              = 'input[name=mb_dis_product_number_'+mb_dis_product_id+']';
    let mb_dis_number                  = parseInt($(this).closest("div.adminMbDisProductCartForm").find(mb_dis_input_name).val());
    let mb_dis_min_stock_qty           = parseInt($('input[name=mb_dis_product_min_stock_qty_'+mb_dis_product_id+']').val()) | 0;
    let sell_quantity                  = parseInt($('input[name=mb_dis_product_sell_quantity_'+mb_dis_product_id+']').val());
    let mb_dis_sell_quantity           = sell_quantity - mb_dis_min_stock_qty;

    let mb_dis_product_inputData       = getMbDisProductInputData(mb_dis_product_id);
    mb_dis_product_inputData.quantity  = mb_dis_number;

    if (mb_dis_number <= mb_dis_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: mb_dis_product_inputData,
        })
        .done((resp) => {
            appendMbDisProductContent(resp);
            $('.adminDisProductOutOfStock_'+mb_dis_product_id).addClass('invisible');
            $('.adminMbDisProductOutOfStock_'+mb_dis_product_id).addClass('invisible');
            closeCart();
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminMbDisProductOutOfStock_'+mb_dis_product_id).removeClass('invisible');
        $('input[name=mb_dis_product_number_'+mb_dis_product_id+']').val(mb_dis_sell_quantity);
    }
});


function getMbDisProductInputData(mb_dis_product_id) {

    let mb_dis_product_name         = $('input[name=mb_dis_product_name_'+mb_dis_product_id+']').val();
    let mb_dis_product_image        = $('input[name=mb_dis_product_image_'+mb_dis_product_id+']').val();
    let mb_dis_product_sale_price   = $('input[name=mb_dis_product_sale_price_'+mb_dis_product_id+']').val();
    let mb_dis_product_type         = $('input[name=mb_dis_product_type_'+mb_dis_product_id+']').val();

    return {product_id: mb_dis_product_id, product_name: mb_dis_product_name, product_image: mb_dis_product_image, amount: mb_dis_product_sale_price, type: mb_dis_product_type};
}

function appendMbDisProductContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}