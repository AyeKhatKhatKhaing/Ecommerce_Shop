$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function adminAreaSet(area) {
    window.location.href = "/set-area/"+area;
}

function adminAreaChange(area) {
    $.ajax({
        type: 'GET',
        url: "/set-area/"+area
    })
    .done((resp) => {
        console.log(resp);
    })
    .fail(() => console.log('Area change failed!'))
}

$(document).on('click', '.adminCloseNewLetter', function() {
    let url = $(this).data('url');

    window.location.href = url;
})
