$( document ).ajaxStart(function() {
    $('#ajax-loader').removeClass('hidden');
});

$( document ).ajaxComplete(function() {
    $('#ajax-loader').addClass('hidden');
});
