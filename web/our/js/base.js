$( document ).ajaxStart(function() {
    $('#ajax-loader').removeClass('hidden');
});

$( document ).ajaxComplete(function() {
    $('#ajax-loader').addClass('hidden');
});

function showSuccess(message) {
    var $alertSuccess = $('.alert-success');
    $alertSuccess.text(message);
    $alertSuccess.fadeTo(2000, 500).slideUp(1000);
}
