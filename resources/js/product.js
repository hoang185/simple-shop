var csrf = "{{ csrf_token() }}" ;
var category = '';
function plusQty(qtyInput) {
    let qty = parseInt($('#'+qtyInput).val());
    if( qty < 100) {
        qty++;
        $('#'+qtyInput).val(qty);
        $(`#${qtyInput}`).data("value", qty);
    }
    else {
        $('#'+qtyInput).val(100);
    }
}
function minusQty(qtyInput) {
    let qty = parseInt($('#'+qtyInput).val());
    if( qty > 1) {
        qty--;
        $('#'+qtyInput).val(qty);
        $(`#${qtyInput}`).data("value", qty);

    }
    else {
        $('#'+qtyInput).val(1);
    }
}
$(document).ready(function () {
    var url = $(location).attr('href');
    var parts = url.split("/");
    console.log(parts, 'parts')
    var last_part = parts[parts.length-1];
    console.log(last_part, 'last param url');

    var leng_option = $('#sorter option').length;
    console.log(url, 'url');

    for(let i = 2; i <= leng_option; i++) {
        var value_option = $('#sorter option:nth-child(' + i +')').val().split("/");
        var last_value_option = value_option[value_option.length-1];
        console.log(last_value_option, 'val op');
        if( last_value_option === last_part) {
            $('#sorter option:nth-child(' + i +')').attr('selected', true);
        }
    }

    var searchParams = new URLSearchParams(window.location.search);
    var page = 1;
    if(searchParams.has('page')){
        page = searchParams.get('page');
    }
    console.log(page);

    if (window.matchMedia('screen and (max-width: 768px)').matches) {
        $('.categories-list ul').removeAttr('style');
        $('.list-trigger').click(function (e) {
            e.stopPropagation();
            return false;
        });
        $(document).on("click", function () {
            if ($('.categories-list').css("display") === "block") {
                $('.categories-list').css("display", "none");
            }
        });
    }

    var sorter = '';
    $('#sorter').change(function() {
        sorter = $('#sorter option:selected').val() ? $('#sorter option:selected').val() : '';
        console.log(sorter)
        window.location.href = $('#sorter').val();
    });

});
