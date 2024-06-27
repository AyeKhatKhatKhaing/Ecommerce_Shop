$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    getCartItem()

    $(document).on('click', '.adminCartIcon', function() {
        getCartItem()
    })

});

/* get all cart items list */
function getCartItem() {
    $.ajax({
        url     : '/get-cart-item',
        type    : 'GET',
        dataType: 'json',
        success : function (resp) {
            // console.log(resp);
            if (resp.is_disabled) {
                $('.adminDisabled').addClass('rem-disabled');
            } else {
                $('.adminDisabled').removeClass('rem-disabled');
            }
            appendContent(resp)
        },
        error: function(resp) {
            console.log(resp)
        }
    });
}

function appendContent(resp) {
    $('#adminCartCount').html(resp.total_quantity)
    $('#adminCartItemLabel').html(resp.total_item_label)
    $('#adminTotalAmount').html(resp.total_amount)
    $('.adminCartItemList').html(resp.html)
}

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