/* single add to cart function when + icon click, this function store only will not update qty (will use product detail page)*/ 
$(".adminAddCart").on('click', function() {
    let product_id               = $(this).data('itemid');
    let sell_quantity            = parseInt($('input[name=p_detail_sell_quantity_'+product_id+']').val());
    let p_detail_number          = parseInt($('input[name=p_detail_number_'+product_id+']').val());
    let p_detail_min_stock_qty   = parseInt($('input[name=p_detail_min_stock_qty_'+product_id+']').val()) | 0;
    let p_detail_sell_quantity   = sell_quantity - p_detail_min_stock_qty;

    let pDetailinputData             = getPDetailInputData(product_id);
    pDetailinputData.quantity         = p_detail_number;
    pDetailinputData.sell_quantity    = p_detail_sell_quantity;

    if (p_detail_number < p_detail_sell_quantity) {
        $.ajax({
            url : "/add-cart",
            type: 'POST',
            dataType: 'json',
            data: pDetailinputData,
        })
        .done((resp) => {
            $('input[name=p_detail_number'+product_id+']').val(resp.quantity)
            appendPDetailContent(resp)
            appendPDetailCartContent(resp)
        })
        .fail((e) => console.log(e))
    } else {
        $('input[name=p_detail_number'+product_id+']').val(p_detail_number);
        $('.adminpDetailOutOfStock').removeClass('hidden');
        $('.adminAssignQauntity').text(p_detail_sell_quantity);
        
    }
});

function getPDetailInputData(product_id) {

    let product_name    = $('input[name=p_detail_name_'+product_id+']').val();
    let product_image   = $('input[name=p_detail_image_'+product_id+']').val();
    let sale_price      = $('input[name=p_detail_sale_price_'+product_id+']').val();
    let type            = $('input[name=p_detail_type_'+product_id+']').val();

    return {product_id: product_id, product_name: product_name, product_image: product_image, amount: sale_price, type: type};
}

function appendPDetailContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}

function appendPDetailCartContent(resp) { /* product detail page mobile cart item */
    $('.adminDetailCartItem').html(resp.detail_html)
    $('.pDetailTotalamount').html(resp.detail_total)
    $('.pDetailTotalQuantity').html(resp.detail_quantity)
}