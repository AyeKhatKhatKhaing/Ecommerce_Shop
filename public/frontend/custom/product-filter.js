var cat_arr = [];

// $('.adminAllPromotion').on('click', function() {
//     let url = getUrl(1);
//     productQuery(url);
//     // console.log('here')
// })

$('.adminPromotion').on('change', () => {
    let url = getUrl(1);
    productQuery(url);
})

$('.adminCountry').on('change', () => {
    let url = getUrl(1);
    productQuery(url);
})

$('.adminRegion').on('change', () => {
    let url = getUrl(1);
    productQuery(url);
})

$('.adminClassification').on('change', () => {
    let url = getUrl(1);
    productQuery(url);
})

$('.adminAttribute').on('change', () => {
    let url = getUrl(1);
    productQuery(url);
})

$(document).on('click', '.adminExclusive', () => {
    let url = getUrl(1);
    productQuery(url);
})

$('.adminSort').on('click change keydown', function () {
    $('#sort-by').val($(this).data('value'));

    let url = getUrl(1);
    productQuery(url);
});

function adminClearAll(url) {
    window.location.href = url;
}

$(document).on('click', '.adminProductPagination', function (e) {
    e.preventDefault();
    let currentPage = parseInt($("input:hidden[name=current_page]").val()) || 0;
    let lastPage = parseInt($("input:hidden[name=last_page]").val()) || 0;
    let option = $(this).data('option');

    if (option == 'left') {
        if (currentPage > 1) {
            currentPage -= 1;
            $('#adminLeftLink').removeClass('rem-disabled');
            $('#adminRightLink').removeClass('rem-disabled');
        }

        if (currentPage == 1) {
            $('#adminLeftLink').addClass('rem-disabled');
            $('#adminRightLink').removeClass('rem-disabled');
            $('#adminLeftArrow').addClass('opacity-30');
            $('#adminRightArrow').removeClass('opacity-30');
        }
    }

    if (option == 'right') {
        if (currentPage != lastPage) {
            currentPage += 1;
            $('#adminLeftLink').removeClass('rem-disabled');
            $('#adminRightLink').removeClass('rem-disabled');
        }
        if (currentPage == lastPage) {
            $('#adminLeftLink').removeClass('rem-disabled');
            $('#adminRightLink').addClass('rem-disabled');
            $('#adminLeftArrow').removeClass('opacity-30');
            $('#adminRightArrow').addClass('opacity-30');
        }
    }

    $("input:hidden[name=current_page]").val(currentPage)
    $(".adminCurrentPage").text(currentPage)

    let url = getUrl()
    productQuery(url);
})

function getUrl(pg = null) {

    const urlParams = new URLSearchParams(window.location.search);
    var page = parseInt($("input:hidden[name=current_page]").val()) || pg;

    let rp_low = parseInt($("input[name=rp_low]").val()) || 0;
    let rp_high = parseInt($("input[name=rp_high]").val()) || 0;
    let ws_low = parseInt($("input[name=ws_low]").val()) || 0;
    let ws_high = parseInt($("input[name=ws_high]").val()) || 0;
    let jh_low = parseInt($("input[name=jh_low]").val()) || 0;
    let jh_high = parseInt($("input[name=jh_high]").val()) || 0;
    let bc_low = parseInt($("input[name=bc_low]").val()) || 0;
    let bc_high = parseInt($("input[name=bc_high]").val()) || 0;
    let js_low = parseInt($("input[name=js_low]").val()) || 0;
    let js_high = parseInt($("input[name=js_high]").val()) || 0;
    let bh_low = parseInt($("input[name=bh_low]").val()) || 0;
    let bh_high = parseInt($("input[name=bh_high]").val()) || 0;

    let price_from = parseInt($("input[name=price_from]").val());
    let price_to = parseInt($("input[name=price_to]").val());

    if (!page)
        page = urlParams.get('page')

    if (page)
        urlParams.set('page', page)

    if (rp_low > 0 && rp_high > 0)
        urlParams.set('rp', rp_low + '-' + rp_high);
    else
        urlParams.delete('rp');

    if (ws_low > 0 && ws_high > 0)
        urlParams.set('ws', ws_low + '-' + ws_high);
    else
        urlParams.delete('ws');

    if (jh_low > 0 && jh_high > 0)
        urlParams.set('jh', jh_low + '-' + jh_high);
    else
        urlParams.delete('jh');

    if (bc_low > 0 && bc_high > 0)
        urlParams.set('bc', bc_low + '-' + bc_high);
    else
        urlParams.delete('bc');

    if (js_low > 0 && js_high > 0)
        urlParams.set('js', js_low + '-' + js_high);
    else
        urlParams.delete('js');

    if (bh_low > 0 && bh_high > 0)
        urlParams.set('bh', bh_low + '-' + bh_high);
    else
        urlParams.delete('bh');

    if ((price_from > 0 && price_to > 0) && (price_from < price_to))
        urlParams.set('price', price_from + '-' + price_to)
    else
        urlParams.delete('price');

    let sort_by = $('#sort-by').val();

    const promotions = [];
    let categories = null;
    const countries = [];
    const regions = [];
    const classifications = [];
    const attributes = [];

    $('.adminPromotion:checked').each(function () {
        promotions.push($(this).val());
    })

    let cats = [];
    $(".filter-categories-selected").map(function() {
        cats.push($(this).data('id'))
    });
    categories = cats.join(",");
    // categories = $('input:hidden[name="categories[]"]').val();

    $('.adminCountry:checked').each(function () {
        countries.push($(this).val());
    })

    $('.adminRegion:checked').each(function () {
        regions.push($(this).val());
    })

    $('.adminClassification:checked').each(function () {
        classifications.push($(this).val());
    })

    $('.adminAttribute:checked').each(function () {
        attributes.push($(this).val());
    })

    let exclusive = $('.adminExclusive:checked').val();

    if (sort_by)
        urlParams.set('sort', sort_by)

    if (promotions.length > 0)
        urlParams.set('pro', promotions.toString());
    else
        urlParams.delete('pro');

    if (categories.length > 0)
        urlParams.set('cat', categories);
    else
        urlParams.delete('cat');

    if (countries.length > 0)
        urlParams.set('cou', countries.toString());
    else
        urlParams.delete('cou');

    if (regions.length > 0)
        urlParams.set('reg', regions.toString());
    else
        urlParams.delete('reg');

    if (classifications.length > 0)
        urlParams.set('cla', classifications.toString());
    else
        urlParams.delete('cla');

    if (attributes.length > 0)
        urlParams.set('att', attributes.toString());
    else
        urlParams.delete('att');

    if (exclusive)
        urlParams.set('exc', exclusive)
    else
        urlParams.delete('exc');



    let main_url = window.location.href.split('?')[0];
    main_url += "?" + urlParams.toString();
    window.history.pushState('', '', main_url);

    // console.log('main_url ', main_url)

    return main_url;
}

function productQuery(url) {
    $.ajax({
        url: url,
    }).done(function (resp) {
        $('.adminProductList').html(resp)
        appendShowing();
    }).fail(function (e) {
        console.log(e)
    })
}

function appendShowing() {
    let first_item = parseInt($("input:hidden[name=first_item]").val()) || 0;
    let last_item = parseInt($("input:hidden[name=last_item]").val()) || 0;

    $('.adminFirstItem').text(first_item);
    $('.adminLastItem').text(last_item);
    
    $('.adminProductListing').attr('data-listing', 'true'); /* if filter will append to product listing +, - button */
}

/* under all js function direct use from frontend scripts.js */

if ($('.checkbox-list').length > 0) {

    $('.checkbox-list input').change(function () {

        let inputs = $(this).parent().parent().siblings().children().children('input');

        if (this.nextElementSibling.innerHTML.trim() === 'All') {

            if (this.checked) {

                inputs.prop('checked', true);

                inputs.map((i, item) => appendText(item.id, item.nextElementSibling.innerHTML.trim()));

            }

            else {

                $(this).parent().parent().siblings().children().children('input').prop('checked', false);

                handleUncheck(inputs, 'All');

            }

        } else {

            if (this.checked) {

                appendText(this.id, this.nextElementSibling.innerHTML.trim());

                if ($(this).parent().parent().siblings().children().children('label').text().trim().includes('All')) {

                    inputs.map((i, item) => {

                        if (item.nextElementSibling.innerHTML.trim() != 'All') {

                            let checkedlength = inputs.filter(':checked').length, checkboxlength = inputs.length - 1;

                            if (checkboxlength == checkedlength) inputs[0].checked = true;

                        }

                    })

                }

            }

            else {

                handleUncheck(this, '');

                if ($(this).parent().parent().siblings().children().children('label').text().trim().includes('All')) inputs[0].checked = false;

            }

        }
        /* Start -> add by backend team script  */
        let url = getUrl(1);
        productQuery(url);
        /* End -> add by backend team script  */
    })

}

$('.categories-container > p').click(function () {

    this.classList.add('filter-categories-selected')

    appendText(this.id, this.innerHTML.trim())


    /* Start -> add by backend team script  */

    let cat_id = $(this).data('id');

    if (!cat_arr.includes(cat_id)) {
        cat_arr.push(cat_id);
    }

    $('input:hidden[name="categories[]"]').val(cat_arr);

    let url = getUrl(1);
    productQuery(url);

    /* End -> add by backend team script  */
})

$('.rating-range').map((i, item) => {
    $(item).on("slidestop", function (event, ui) {
        let values = ui.values;

        let text = `${$(this).siblings('.montserrat').text().trim()}: [${values[0]} - ${values[1]}]`;

        appendText(this.parentElement.id, text);

        /* Start -> add by backend team script  */
        let url = getUrl(1);
        productQuery(url);
        /* End -> add by backend team script  */
    });
})

$('.productsidebar-content .price-filterslider').map((i, item) => {

    $(item).on("slidestop", function (event, ui) {
        var values = ui.values;

        let text = `Price: [${values[0]} - ${values[1]}]`;

        appendText(this.parentElement.id, text);

        /* Start -> add by backend team script  */
        let url = getUrl(1);
        productQuery(url);
        /* End -> add by backend team script  */
    });
});


$(document).on('click', '.filter-cross', function () {

    let id = this.parentElement.dataset.id;

    document.querySelectorAll('.checkbox-list input').forEach(item => {

        if (id == item.id) item.checked = false;

    })

    $('.categories-container > p').map((i, item) => {
        if(item.id == id) item.classList.remove('filter-categories-selected');
    })

    this.parentElement.remove();

    $('.rating-range').each(function () {

        if (this.parentElement.id == id) {

            let activeslider = $(`#${id}`).children('.rating-range');

            let options = $(activeslider).slider('option');

            $(activeslider).slider('values', [options.min, options.max]);

            $(activeslider).children('.ui-slider-handle').first().text(options.min);

            $(activeslider).children('.ui-slider-handle').last().text(options.max);

            $(activeslider).parent().children('#low-rate').val(options.min);

            $(activeslider).parent().children('#high-rate').val(options.max);

        }

    });

    $('.productsidebar-content .price-filterslider').each(function () {
        if (this.parentElement.id == id) {

            let options = $(this).slider('option');

            $(this).slider('values', [options.min, options.max]);

            $('.productsidebar-content #lowest-price').val(options.min);

            $('.productsidebar-content #highest-price').val(options.max);

        }
    });

    /* Start -> add by backend team script  */
    let url = getUrl(1);
    productQuery(url);
    /* End -> add by backend team script  */

});

if ($('#sidebar_pricerange').length > 0) {

    let lowest = document.querySelector('.collapse-content .lowest-price > input');

    let highest = document.querySelector('.collapse-content .highest-price > input');

    let pricemin = +lowest.value, pricemax = +highest.value;

    $('#sidebar_pricerange .price-filterslider').slider({

        min: pricemin,

        max: pricemax,

        values: [pricemin, pricemax],

        range: true,

        slide: function (event, ui) {

            var values = ui.values;

            lowest.value = values[0];

            highest.value = values[1];

        }

    });

    lowest.addEventListener('input', function () {
        $('#sidebar_pricerange .price-filterslider').slider('values', 0, $(this).val());
        /* Start -> add by backend team script  */
        let url = getUrl(1);
        productQuery(url);
        /* End -> add by backend team script  */
    })

    highest.addEventListener('input', function () {

        $('#sidebar_pricerange .price-filterslider').slider('values', 1, $(this).val());
        /* Start -> add by backend team script  */
        let url = getUrl(1);
        productQuery(url);
        /* End -> add by backend team script  */
    })

    
}