if( $('#individual-account').is(':checked') ){
    $('#company-acc').addClass('hidden');
}

if( $('#company-acc').is(':checked') ){
    $('#individual-account').addClass('hidden');
}

if ($('.adminComCheck').hasClass('peer-checked:block')){
    $('#company-acc').removeClass('hidden');
}


$('#individual-account').on('click', function() {
    $('#individual-acc').removeClass('hidden');
    $('#company-acc').addClass('hidden');
    $('.adminComCheck').addClass('hidden');
    $('.adminIndiUncheck').addClass('hidden');
    $('.adminComUncheck').removeClass('hidden');
    $('.adminIndiCheck').removeClass('hidden');
    $('.adminIndiCheck').removeClass('peer-checked:hidden');
    $('.adminIndiCheck').addClass('peer-checked:block');
})

$('#company-account').on('click', function() {
    $('#company-acc').removeClass('hidden');
    $('#individual-acc').addClass('hidden');
    $('.adminIndiCheck').addClass('hidden');
    $('.adminIndiUncheck').removeClass('hidden');
    $('.adminComUncheck').addClass('hidden');
})


let comOtpInput = document.getElementById('com_otp');  /* for company account */
comOtpInput.addEventListener('input', function() {
    let comOtpCode = comOtpInput.value;
    if (/^\d{6}$/.test(comOtpCode)) {
        verifyComOTP(comOtpCode);
    }
});

$('#adminGetComOTP').on('click', function () {
    checkComBanTime();
})

function checkComBanTime() {
    var csrfToken    = $('meta[name="csrf-token"]').attr('content');
    var phone        = $('input[name="com_phone"]').val();
    var country_code = $('input[name="com_country_code"]').val();
    var phone        = checkPhoneFormat(country_code, phone);
    $.ajax({
        url: '/get-otp',
        type: 'POST',
        data: {
            _token: csrfToken,
            phone_number: country_code + phone,
        },
        success: function(resp) {
            console.log(resp);
            if(resp.status == true) {
                $('#com-phone-error').text(resp.message).removeClass('hidden').css('color', 'green');
                
            } else {
                $('#com-phone-error').text(resp.message).removeClass("hidden").css('color', 'red');
            }
        },
        error: function(error) {
            console.log("Error:", error);
        }
    });
}

function verifyComOTP(otp) {
    var csrfToken    = $('meta[name="csrf-token"]').attr('content');
    var phone        = $('input[name="com_phone"]').val();
    var country_code = $('input[name="com_country_code"]').val();
    var phone        = checkPhoneFormat(country_code, phone);
    $.ajax({
        url: '/verify-otp',
        type: 'POST',
        data: {
            _token: csrfToken,
            phone: country_code + phone,
            otp_code: otp,
        },
        success: function(resp) {
            if (resp.status == true) {
                $("#com_opt").prop("disabled", true);
                $("#com-otp-error").text(resp.message).removeClass('hidden').css('color', 'green');
                $("#register-btn").prop("disabled", false);
                $('#com_verify_or_not').val(true)
            } else {
                $("#com_otp").prop("disabled", false);
                $("#com-otp-error").text(resp.message).removeClass('hidden').css('color', 'red');
                $('#com_verify_or_not').val(false)
            }
        },
        error: function(error) {

        }
    });
}