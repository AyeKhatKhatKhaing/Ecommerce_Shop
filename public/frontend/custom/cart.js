$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.adminCheckCart', function() {
    let product_id         = $(this).data('itemid');
    let input_name         ='input[name=number_'+product_id+']';
    let number             = parseInt($(this).closest("div.adminCartForm").find(input_name).val());
    let get_sell_quantity  = parseInt($('input[name=sell_quantity_'+product_id+']').val());
    let min_stock_qty      = parseInt($('input[name=min_stock_qty_'+product_id+']').val()) | 0;
    let sell_quantity      = get_sell_quantity - min_stock_qty;

    let inputData          = getInputData(product_id);
    inputData.quantity     = 1;

    if (number <= sell_quantity ) {  /* click plus button and then add to cart */      
        $.ajax({
            url : "/check-cart",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: product_id,
                inputData: inputData
            },
        })
        .done((resp) => {
            appendContent(resp);   /* to append click plus button add to cart data in header */
            $('input[name=number_'+product_id+']').val(resp.quantity);
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminOutOfStock'+product_id).removeClass('invisible');
        $('input[name=number_'+product_id+']').val(sell_quantity);
    }
})

/* single add to cart function when + icon click, this function store only will not update qty (will use product detail page)*/ 
$(".adminAddCart").on('click', function() {

    let product_id          = $(this).data('itemid');
    let get_sell_quantity   = parseInt($('input[name=sell_quantity_'+product_id+']').val());
    let number              = parseInt($('input[name=number_'+product_id+']').val());
    let min_stock_qty       = parseInt($('input[name=min_stock_qty_'+product_id+']').val()) | 0;
    let sell_quantity       = get_sell_quantity - min_stock_qty;

    let inputData           = getInputData(product_id);
    inputData.quantity      = number;

    $('.adminOutOfStock').addClass('hidden');

    if (number <= sell_quantity) {
        $.ajax({
            url : "/add-cart",
            type: 'POST',
            dataType: 'json',
            data: inputData,
        })
        .done((resp) => {
            $('input[name=number_'+product_id+']').val(resp.quantity)
            appendContent(resp)
        })
        .fail((e) => console.log(e))
    } else {
        $('input[name=number_'+product_id+']').val(sell_quantity);
        $('.adminOutOfStock').removeClass('hidden');
        $('.adminAssignQauntity').text(sell_quantity);
        
    }

});

/* multi update cart function with increase and decrease action */
$(document).on('click', '.adminCartUpdate', function() {

    let product_id          = $(this).data('itemid');
    let action              = $(this).data('action');
    let isListing           = $(this).data('listing'); /* if listing is true this data will come from product listing pages */
    let min_stock_qty       = parseInt($('input[name=min_stock_qty_'+product_id+']').val()) | 0;
    let get_sell_quantity   = parseInt($('input[name=sell_quantity_'+product_id+']').val());
    let sell_quantity       = get_sell_quantity - min_stock_qty;
    let input_name          = 'input[name=number_'+product_id+']';
    let number              = parseInt($(this).closest("div.adminCartForm").find(input_name).val());
    let warning_status      = true;

//     if(isListing) {
//         if(action == 'decrease' && number > 0) {
//             number --;
//         }
//         if(action == 'increase') {
//             number ++;
//         }
// }

    if (action == 'decrease') {
        let warning_status = true;
    }

    let inputData       = getInputData(product_id);
    inputData.quantity  = number;

    $('.adminOutOfStock_'+product_id).addClass('invisible');
    $('.adminWarningMeg_'+product_id).removeClass('warning-msg');
    // $('.adminOutOfStock_'+product_id).remove();

    if (number <= sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: inputData,
        })
        .done((resp) => {
            appendContent(resp)
            $('input[name=number_'+product_id+']').val(resp.quantity);
            $('.adminWarningMeg_'+product_id).removeClass('warning-msg');

            if (warning_status) { 
                $('.adminOutOfStockText_'+product_id).addClass('hidden');
                $('.adminOutOfStockText_'+product_id).html('');
            }
        })
        .fail((e) => console.log(e))
    } else {
        $('input[name=number_'+product_id+']').val(sell_quantity);
        $('.adminOutOfStock_'+product_id).removeClass('invisible');
        $('.adminWarningMeg_'+product_id).addClass('warning-msg');
        $('.adminAssignQauntity_'+product_id).text(sell_quantity);
        $('.adminOutOfStockText_'+product_id).removeClass('hidden');    /* for cart page warning message */
        $('.adminOutOfStockText_'+product_id).html(`  
            <td colspan="4">
                <div class="flex items-center border-2 border-mainyellow rounded py-1 px-2">
                    <span class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-[#F79E1B] mr-2 text-[#F79E1B]">i</span>
                    <p class="montserrat-medium text-remdark rem-text-16 flex-[0_1_80%] max-w-[80%]">This product is
                        temporarily out of stock because of high demand, you can add maximum <span class="adminAssignQauntity_${product_id}">${sell_quantity}</span> item to cart.
                    </p>
                </div>
            </td>
        `);/* for cart page warning message */
    }
});

$(document).on('click', '.adminMobileCartUpdate', function() {
    let product_id          = $(this).data('itemid');
    let input_name          = 'input[name=number_'+product_id+']';
    let number              = parseInt($(this).closest("div.adminMobileCartForm").find(input_name).val());
    let min_stock_qty       = parseInt($('input[name=min_stock_qty_'+product_id+']').val()) | 0;
    let get_sell_quantity   = parseInt($('input[name=sell_quantity_'+product_id+']').val());
    let sell_quantity       = get_sell_quantity - min_stock_qty;

    let inputData           = getInputData(product_id);
    inputData.quantity      = number;

    $('.adminOutOfStock').addClass('invisible');

    if (number <= sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: inputData,
        })
        .done((resp) => {
            appendContent(resp);
            closeCart();
        })
        .fail((e) => console.log(e))
    } else {
        $('.adminOutOfStock_'+product_id).removeClass('invisible');
        $('input[name=number_'+product_id+']').val(sell_quantity);
    }
});

$(document).on('click', '.removeCartItem', function() {
    let item_id  = $(this).data('id');
    removeCartItem(item_id);
})

function removeCartItem(item_id)
{
    $.ajax({
        url : "/remove-cart-item",
        type: 'DELETE',
        dataType: 'json',
        data: {item_id: item_id},
    })
    .done((resp) => {
        if(resp.status) {
            location.reload(); 
        }
    })
    .fail((e) => console.log(e))
}

function getInputData(product_id) {

    let product_name    = $('input[name=name_'+product_id+']').val();
    let product_image   = $('input[name=image_'+product_id+']').val();
    let sale_price      = $('input[name=sale_price_'+product_id+']').val();
    let type            = $('input[name=type_'+product_id+']').val();

    return {product_id: product_id, product_name: product_name, product_image: product_image, amount: sale_price, type: type};
}

function appendContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
    $('.adminDisabled').removeClass('rem-disabled');
}

$('.adminCoupon').on('click', function (){
    let coupon_code    = $(this).attr('data-couponCode');
    let coupon_hist_id = $(this).attr('data-couponHisId');
    let coupon_id      = $(this).attr('data-couponId');

    $('input[name="coupon_code"]').val(coupon_code);
    $('input[name="coupon_code"]').attr('data-couponHisId', coupon_hist_id);
    $('input[name="coupon_code"]').attr('data-couponId', coupon_id);

    $('input[name="no_coupon"]').val('false');
})

$('.adminCouponStatus').on('click', function () {
    $('input[name="no_coupon"]').val('true');
    let no_coupon          = $('input[name="no_coupon"]').val();
    var original_sub_total = $('input[name="original_sub_total"]').val();

        $.ajax({
            url : "/get-coupon-amount",
            type: 'POST',
            dataType: 'json',
            data: {
                no_coupon : no_coupon,
                original_sub_total : original_sub_total,
            },
        })
        .done((resp) => {
            $('.adminSubTotal').text(resp.update_total_amount);
            $('.couponMessage').html(resp.message);
            $('.adminCartCoupon').addClass('hidden');
            $('.adminCheckText').text('Select Coupon Code');
            $('input[name="update_sub_total"]').val(resp.update_total_amount);
            if (resp.status == true) {
                $('.adminCouponStatus').removeClass('hidden');
            } else {
                $('.adminCouponStatus').addClass('hidden');
            }
        })
        .fail((e) => console.log(e))
})

$('.adminApplyCoupon').on('click', function() {
    let coupon_code        = $('input[name="coupon_code"]').val();
    let original_sub_total = $('input[name="original_sub_total"]').val();
    let coupon_his_id      = $('input[name="coupon_code"]').attr('data-couponHisId');
    let coupon_id          = $('input[name="coupon_code"]').attr('data-couponId');

    if (coupon_code !== '') {
        $.ajax({
            url : "/get-coupon-amount",
            type: 'POST',
            dataType: 'json',
            data: {
                coupon_code        : coupon_code,
                original_sub_total : original_sub_total,
                coupon_his_id      : coupon_his_id,
                coupon_id          : coupon_id
            },
        })
        .done((resp) => {
            $('.adminSubTotal').text(resp.update_total_amount);
            $('.couponMessage').html(resp.message);
            $('.adminCartCoupon').removeClass('hidden');
            $('input[name="update_sub_total"]').val(resp.update_total_amount);
            $('.adminCouponAmt').text(resp.coupon_amount);
            if (resp.status == true) {
                $('.adminCouponStatus').removeClass('hidden');
            } else {
                $('.adminCouponStatus').addClass('hidden');
            }
        })
        .fail((e) => console.log(e))
    }
})
 
$(".adminInputNumber").bind('keyup mouseup', function () {   /* add to cart key up number for cart listing pages */
    console.log(this.value);
    let product_id          = $(this).data('itemid');
    let action              = $(this).data('action');
    let isListing           = $(this).data('listing'); /* if listing is true this data will come from product listing pages */
    let min_stock_qty       = parseInt($('input[name=min_stock_qty_'+product_id+']').val()) | 0;
    let get_sell_quantity   = parseInt($('input[name=sell_quantity_'+product_id+']').val());
    let sell_quantity       = get_sell_quantity - min_stock_qty;
    let input_name          = 'input[name=number_'+product_id+']';
    let number              = parseInt($(this).closest("div.adminCartForm").find(input_name).val());
    let warning_status      = true;

    let inputData           = getInputData(product_id);
    inputData.quantity      = number;

    $('.adminOutOfStock_'+product_id).addClass('invisible');
    $('.adminWarningMeg_'+product_id).removeClass('warning-msg');

    if (number <= sell_quantity) {
        $.ajax({
            url : "/update-cart",
            type: 'POST',
            dataType: 'json',
            data: inputData,
        })
        .done((resp) => {
            appendContent(resp)
            $('input[name=number_'+product_id+']').val(resp.quantity);
            $('.adminWarningMeg_'+product_id).removeClass('warning-msg');

            if (warning_status) { 
                $('.adminOutOfStockText_'+product_id).addClass('hidden');
            }
        })
        .fail((e) => console.log(e))
    } else {
        $('input[name=number_'+product_id+']').val(sell_quantity);
        $('.adminOutOfStock_'+product_id).removeClass('invisible');
        $('.adminWarningMeg_'+product_id).addClass('warning-msg');
        $('.adminAssignQauntity_'+product_id).text(sell_quantity);
        $('.adminOutOfStockText_'+product_id).removeClass('hidden');    /* for cart page warning message */
        $('.adminOutOfStockText_'+product_id).html(`  
            <td colspan="4">
                <div class="flex items-center border-2 border-mainyellow rounded py-1 px-2">
                    <span class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-[#F79E1B] mr-2 text-[#F79E1B]">i</span>
                    <p class="montserrat-medium text-remdark rem-text-16 flex-[0_1_80%] max-w-[80%]">This product is
                        temporarily out of stock because of high demand, you can add maximum <span class="adminAssignQauntity_${product_id}">${sell_quantity}</span> item to cart.
                    </p>
                </div>
            </td>
        `);/* for cart page warning message */
    }

});