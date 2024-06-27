$(document).on('click', '.adminExclusiveCheckCart', function() {
    let exclusive_product_id     = $(this).data('itemid');
    let exclusive_input_name     = 'input[name=exclusive_number_'+exclusive_product_id+']';
    let exclusive_number         = parseInt($(this).closest("div.adminExclusiveCartForm").find(exclusive_input_name).val());
    let sell_quantity            = parseInt($('input[name=exclusive_sell_quantity_'+exclusive_product_id+']').val());
    let exclusive_min_stock_qty  = parseInt($('input[name=exclusive_min_stock_qty_'+exclusive_product_id+']').val()) | 0;
    let exclusive_sell_quantity  = sell_quantity - exclusive_min_stock_qty;

    let exclusiveInputData       = getExclusiveInputData(exclusive_product_id);
    exclusiveInputData.quantity  = 1;
    
    if (exclusive_number <= exclusive_sell_quantity) {
          /* click plus button and then add to cart */      
        $.ajax({
            url : "/check-cart",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: exclusive_product_id,
                inputData: exclusiveInputData,
                sell_quantity: exclusive_sell_quantity,
                min_stock_qty: exclusive_min_stock_qty
            },
        })
        .done((resp) => {
            appendExclusiveContent(resp);   /* to append click plus button add to cart data in header */
            if (resp.quantity.status == true) { /* if input quantity is greater than sell quanity */
                $('.adminExclusiveOutOfStock_'+exclusive_product_id).removeClass('invisible');
                $('input[name=exclusive_number_'+exclusive_product_id+']').val(resp.quantity.quantity);
            } else {
                $('input[name=exclusive_number_'+exclusive_product_id+']').val(resp.quantity);
            }
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminExclusiveOutOfStock_'+exclusive_product_id).removeClass('invisible');
        $('input[name=exclusive_number_'+exclusive_product_id+']').val(exclusive_sell_quantity);
    }
})

/* multi update cart function with increase and decrease action */
$(document).on('click', '.adminExclusiveCartUpdate', function() {

    let exclusive_product_id      = $(this).data('itemid');
    let exclusive_min_stock_qty   = parseInt($('input[name=exclusive_min_stock_qty_'+exclusive_product_id+']').val()) | 0;
    let sell_quantity             = parseInt($('input[name=exclusive_sell_quantity_'+exclusive_product_id+']').val());
    let exclusive_input_name      = 'input[name=exclusive_number_'+exclusive_product_id+']';
    let exclusive_number          = parseInt($(this).closest("div.adminExclusiveCartForm").find(exclusive_input_name).val());
    let exclusive_sell_quantity   = sell_quantity - exclusive_min_stock_qty;

    let exclusiveInputData        = getExclusiveInputData(exclusive_product_id);
    exclusiveInputData.quantity   = exclusive_number;


    if (exclusive_number <= exclusive_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: exclusiveInputData,
        })
        .done((resp) => {
            appendExclusiveContent(resp)
            $('.adminExclusiveOutOfStock_'+exclusive_product_id).addClass('invisible');
            $('input[name=exclusive_number'+exclusive_product_id+']').val(resp.quantity);
        })
        .fail((e) => console.log(e))
    } else {
        $(this).closest("div.adminExclusiveCartForm").find(exclusive_input_name).val(exclusive_sell_quantity)
        $('.adminExclusiveOutOfStock_'+exclusive_product_id).removeClass('invisible');
    }
});

function getExclusiveInputData(exclusive_product_id) {

    let exclusive_product_name    = $('input[name=exclusive_name_'+exclusive_product_id+']').val();
    let exclusive_product_image   = $('input[name=exclusive_image_'+exclusive_product_id+']').val();
    let exclusive_sale_price      = $('input[name=exclusive_sale_price_'+exclusive_product_id+']').val();
    let exclusive_type            = $('input[name=exclusive_type_'+exclusive_product_id+']').val();

    return {product_id: exclusive_product_id, product_name: exclusive_product_name, product_image: exclusive_product_image, amount: exclusive_sale_price, type: exclusive_type};
}

function appendExclusiveContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}
