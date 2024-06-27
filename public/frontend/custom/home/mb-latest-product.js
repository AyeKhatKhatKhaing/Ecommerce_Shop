$(document).on('click', '.adminMbLatestCheckCart', function() {
    let mb_product_id      = $(this).data('itemid');
    let mb_input_name      = 'input[name=mb_latest_number_'+mb_product_id+']';
    let mb_number          = parseInt($(this).closest("div.adminMbLatestCartForm").find(mb_input_name).val());
    let sell_quantity      = parseInt($('input[name=mb_latest_sell_quantity_'+mb_product_id+']').val());
    let mb_min_stock_qty   = parseInt($('input[name=mb_latest_min_stock_qty_'+mb_product_id+']').val()) | 0;
    let mb_sell_quantity   = sell_quantity - mb_min_stock_qty;

    let mbInputData        = getMbLatestInputData(mb_product_id);
    mbInputData.quantity   = 1;
    

    if (mb_number <= mb_sell_quantity) {  /* click plus button and then add to cart */      
        $.ajax({
            url : "/check-cart",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: mb_product_id,
                inputData: mbInputData,
                sell_quantity: mb_sell_quantity,
                min_stock_qty: mb_min_stock_qty
            },
        })
        .done((resp) => {
            appendMobileLatestContent(resp);   /* to append click plus button add to cart data in header */
            if (resp.quantity.status == true) { /* if input quantity is greater than sell quanity */
                $('.adminLatestOutOfStock_'+mb_product_id).removeClass('invisible');
                $('.adminMbLatestOutOfStock_'+mb_product_id).removeClass('invisible');
                $('input[name=mb_latest_number_'+mb_product_id+']').val(resp.quantity.quantity);
            } else {
                $('input[name=mb_latest_number_'+mb_product_id+']').val(resp.quantity);
            }
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminLatestOutOfStock_'+mb_product_id).removeClass('invisible');
        $('input[name=mb_latest_number_'+mb_product_id+']').val(mb_sell_quantity);
    }
});

$(document).on('click', '.adminMbLatestCartUpdate', function() {
    let mb_product_id      = $(this).data('itemid');
    let mb_input_name      = 'input[name=mb_latest_number_'+mb_product_id+']';
    let mb_number          = parseInt($(this).closest("div.adminMbLatestCartForm").find(mb_input_name).val());
    let mb_min_stock_qty   = parseInt($('input[name=mb_latest_min_stock_qty_'+mb_product_id+']').val()) | 0;
    let sell_quantity      = parseInt($('input[name=mb_latest_sell_quantity_'+mb_product_id+']').val());
    let mb_sell_quantity   = sell_quantity - mb_min_stock_qty;
    
    let mbInputData        = getMbLatestInputData(mb_product_id);
    mbInputData.quantity   = mb_number;

    if (mb_number <= mb_sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: mbInputData,
        })
        .done((resp) => {
            appendMobileLatestContent(resp);
            $('.adminMbLatestOutOfStock_'+mb_product_id).addClass('invisible');
            closeCart();
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminMbLatestOutOfStock_'+mb_product_id).removeClass('invisible');
        $('input[name=mb_latest_number_'+mb_product_id+']').val(mb_sell_quantity);
    }
});

function getMbLatestInputData(mb_product_id) {

    let mb_product_name    = $('input[name=mb_latest_name_'+mb_product_id+']').val();
    let mb_product_image   = $('input[name=mb_latest_image_'+mb_product_id+']').val();
    let mb_sale_price      = $('input[name=mb_latest_sale_price_'+mb_product_id+']').val();
    let mb_type            = $('input[name=mb_latest_type_'+mb_product_id+']').val();

    return {product_id: mb_product_id, product_name: mb_product_name, product_image: mb_product_image, amount: mb_sale_price, type: mb_type};
}


function appendMobileLatestContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}