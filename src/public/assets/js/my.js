$('form').submit(function () {
    let button = $(this).find("button[type=submit]:focus");
    button.prop('disabled', true);
    button.html('<i class="spinner-border spinner-border-sm text-light"></i> ' + $(button).text() + '');
});
$(".numberFormat").keyup(function () {
    let number = $(this).val()
        .replace(/[^0-9.]/g, '')
        .replace(/\.+/g, '.')
        .replace(/^(\d*\.?)|\./g, '$1');

    $(this).val(addCommas(number));
});

function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    var x2 = x.length > 1 ? '.' + x[1] : '';
    return x1 + x2;
}
