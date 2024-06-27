$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

if( $('#delivery').is(':checked') ){
    $('#pickup').addClass('hidden');
}

if ($('.adminStoreCheck').hasClass('peer-checked:block')){
    $('#pickup').removeClass('hidden');
}

$('#delivery').on('click', function() {
    $('#deli').removeClass('hidden');
    $('#pickup').addClass('hidden');
    $('.adminStoreCheck').addClass('hidden');
    $('.adminDeliUncheck').addClass('hidden');
    $('.adminStoreUncheck').removeClass('hidden');
    $('.adminDeliCheck').removeClass('hidden');
    $('.adminDeliCheck').removeClass('peer-checked:hidden');
    $('.adminDeliCheck').addClass('peer-checked:block');
});

$('#pick-up').on('click', function() {
    $('#pickup').removeClass('hidden');
    $('#deli').addClass('hidden');
    $('.adminDeliCheck').addClass('hidden');
    $('.adminDeliUncheck').removeClass('hidden');
    $('.adminStoreUncheck').addClass('hidden');
});

$('.adminCheckCoupon').on('click', function (){
    var coupon_code    = $(this).attr('data-couponCode');
    let coupon_hist_id = $(this).attr('data-couponHisId');
    let coupon_id      = $(this).attr('data-couponId');

    $('input[name="check_coupon_code"]').val(coupon_code);
    $('input[name="check_coupon_code"]').attr('data-couponHisId', coupon_hist_id);
    $('input[name="check_coupon_code"]').attr('data-couponId', coupon_id);

    $('input[name="no_coupon"]').val('false');
})

$('.adminCouponStatus').on('click', function () {
    $('input[name="no_coupon"]').val('true');
    let no_coupon          = $('input[name="no_coupon"]').val();
    var original_sub_total = $('input[name="original_total_amount"]').val();

        $.ajax({
            url : "/get-checkout-coupon-amount",
            type: 'POST',
            dataType: 'json',
            data: {
                no_coupon : no_coupon,
                original_sub_total : original_sub_total,
            },
        })
        .done((resp) => {
            $('.adminCheckSubTotal').text(resp.update_total_amount);
            $('.adminCouponAmount').text(resp.coupon_amount);
            $('#coupon-amount').val(resp.coupon_amount);
            $('input[name="update_check_sub_total"]').val(resp.update_total_amount);
            $('input[name="coupon_id"]').val(resp.coupon_id);
            $('input[name="coupon_his_id"]').val(resp.coupon_his_id);
            $('.adminCouponMessage').html(resp.message);
            $('.adminSelectText').text('Select your option');
            if (resp.status == true) {
                $('.adminCouponStatus').removeClass('hidden');
            } else {
                $('.adminCouponStatus').addClass('hidden');
            }
        })
        .fail((e) => console.log(e))
})

$('.adminCheckApplyCoupon').on('click', function() {
    var coupon_code        = $('input[name="check_coupon_code"]').val();
    var original_sub_total = $('input[name="original_total_amount"]').val();
    let coupon_his_id      = $('input[name="check_coupon_code"]').attr('data-couponHisId');
    let coupon_id          = $('input[name="check_coupon_code"]').attr('data-couponId');
    let no_coupon          = $('input[name="no_coupon"]').val();

    console.log(coupon_code, original_sub_total);

    if (coupon_code != '') {
        $.ajax({
            url : "/get-checkout-coupon-amount",
            type: 'POST',
            dataType: 'json',
            data: {
                coupon_code : coupon_code,
                original_sub_total : original_sub_total,
                coupon_his_id      : coupon_his_id,
                coupon_id          : coupon_id,
                no_coupon : no_coupon
            },
        })
        .done((resp) => {
            $('.adminCheckSubTotal').text(resp.update_total_amount);
            $('.adminCouponAmount').text(resp.coupon_amount);
            $('#coupon-amount').val(resp.coupon_amount);
            $('input[name="update_check_sub_total"]').val(resp.update_total_amount);
            $('input[name="coupon_id"]').val(resp.coupon_id);
            $('input[name="coupon_his_id"]').val(resp.coupon_his_id);
            $('.adminCouponMessage').html(resp.message);
            if (resp.status == true) {
                $('.adminCouponStatus').removeClass('hidden');
            } else {
                $('.adminCouponStatus').addClass('hidden');
            }
        })
        .fail((e) => console.log(e))
    }
})