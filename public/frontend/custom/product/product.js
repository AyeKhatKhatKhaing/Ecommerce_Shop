$(document).on('click', '.adminProductCheckCart', function() {
    let product_id              = $(this).data('itemid');
    let product_input_name      ='input[name=product_number_'+product_id+']';
    let product_number          = parseInt($(this).closest("div.adminProductCartForm").find(product_input_name).val());
    let sell_quantity           = parseInt($('input[name=product_sell_quantity_'+product_id+']').val());
    let product_min_stock_qty   = parseInt($('input[name=product_min_stock_qty_'+product_id+']').val()) | 0;
    let product_sell_quantity   = sell_quantity - product_min_stock_qty;

    let productInputData        = getProductInputData(product_id);
    productInputData.quantity   = 1;

    if (product_number <= product_sell_quantity) {  /* click plus button and then add to cart */      
        $.ajax({
            url : "/check-cart",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: product_id,
                inputData: productInputData,
                sell_quantity: product_sell_quantity,
                min_stock_qty: product_min_stock_qty
            },
        })
        .done((resp) => {
            appendProductContent(resp);   /* to append click plus button add to cart data in header */
            if (resp.quantity.status == true) { /* if input quantity is greater than sell quanity */
                $('.adminProductOutOfStock_'+product_id).removeClass('invisible');
                $('.adminMbProductOutOfStock_'+product_id).removeClass('invisible');
                $('input[name=product_number_'+product_id+']').val(resp.quantity.quantity);
                $('input[name=mb_product_number_'+product_id+']').val(resp.quantity.quantity);
            } else {
                $('input[name=product_number_'+product_id+']').val(resp.quantity);
                $('input[name=mb_product_number_'+product_id+']').val(resp.quantity);
            }
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminProductOutOfStock_'+product_id).removeClass('invisible');
        $('.adminMbProductOutOfStock_'+product_id).removeClass('invisible');
        $('input[name=product_number_'+product_id+']').val(product_sell_quantity);
    }
})

$(document).on('click', '.adminProductCartUpdate', function() {

    let product_id              = $(this).data('itemid');
    let action                  = $(this).data('action');
    let isListing               = $(this).data('listing'); /* if listing is true this data will come from product listing pages */
    let product_min_stock_qty   = parseInt($('input[name=product_min_stock_qty_'+product_id+']').val()) | 0;
    let sell_quantity           = parseInt($('input[name=product_sell_quantity_'+product_id+']').val());
    let product_input_name      = 'input[name=product_number_'+product_id+']';
    let product_number          = parseInt($(this).closest("div.adminProductCartForm").find(product_input_name).val());
    let product_sell_quantity   = sell_quantity - product_min_stock_qty;

    if(isListing) {
        if(action == 'decrease' && product_number > 0) {
            product_number --;
        }
        if(action == 'increase') {
            product_number ++;
        }
}

    let productInputData       = getProductInputData(product_id);
    productInputData.quantity  = product_number;

    if (product_number <= product_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: productInputData,
        })
        .done((resp) => {
            appendProductContent(resp)
            $('.adminProductOutOfStock_'+product_id).addClass('invisible');
            $('input[name=product_number_'+product_id+']').val(resp.quantity);
        })
        .fail((e) => console.log(e))
    } else {
        $('input[name=product_number_'+product_id+']').val(product_sell_quantity);
        $('.adminProductOutOfStock_'+product_id).removeClass('invisible');
    }
});

function getProductInputData(product_id) {

    let product_name    = $('input[name=product_name_'+product_id+']').val();
    let product_image   = $('input[name=product_image_'+product_id+']').val();
    let sale_price      = $('input[name=product_sale_price_'+product_id+']').val();
    let type            = $('input[name=product_type_'+product_id+']').val();

    return {product_id: product_id, product_name: product_name, product_image: product_image, amount: sale_price, type: type};
}

function appendProductContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}


$(document).on('click', '.adminMbProductCartUpdate', function() {
    let mb_product_id            = $(this).data('itemid');
    let mb_product_input_name    = 'input[name=mb_product_number_'+mb_product_id+']';
    let mb_product_number        = parseInt($(this).closest("div.adminMbProductCartForm").find(mb_product_input_name).val());
    let mb_product_min_stock_qty = parseInt($('input[name=mb_product_min_stock_qty_'+mb_product_id+']').val()) | 0;
    let sell_quantity            = parseInt($('input[name=mb_product_sell_quantity_'+mb_product_id+']').val());
    let mb_product_sell_quantity = sell_quantity - mb_product_min_stock_qty;

    let mbProductInputData       = getMbProductInputData(mb_product_id);
    mbProductInputData.quantity  = mb_product_number;

    if (mb_product_number <= mb_product_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: mbProductInputData,
        })
        .done((resp) => {
            appendMbProductContent(resp);
            $('.adminProductOutOfStock_'+mb_product_id).addClass('invisible');
            $('.adminMbProductOutOfStock_'+mb_product_id).addClass('invisible');
            closeCart();
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminMbProductOutOfStock_'+mb_product_id).removeClass('invisible');
        $('input[name=mb_product_number_'+mb_product_id+']').val(mb_product_sell_quantity);
    }
});

function getMbProductInputData(mb_product_id) {

    let mb_product_name    = $('input[name=product_name_'+mb_product_id+']').val();
    let mb_product_image   = $('input[name=product_image_'+mb_product_id+']').val();
    let mb_sale_price      = $('input[name=product_sale_price_'+mb_product_id+']').val();
    let mb_type            = $('input[name=product_type_'+mb_product_id+']').val();

    return {product_id: mb_product_id, product_name: mb_product_name, product_image: mb_product_image, amount: mb_sale_price, type: mb_type};
}

function appendMbProductContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}