$( document ).ready(function() {

    var $submitButton = $('#submit-button');

    $submitButton.prop('disabled', false);

    function showSuccess(text) {
        var $alertSuccess = $('.alert-success');
        $alertSuccess.text(text);
        $alertSuccess.fadeTo(2000, 500).slideUp(1000);
    }

    $.formUtils.addValidator({
        name : 'needSelection',
        validatorFunction : function(value) {
            return value != null;
        },
        errorMessage : 'You need to select at least one option',
        errorMessageKey: 'optionNotSelected'
    });

    $submitButton.on('click', function(e) {

        $.validate({

            onSuccess : function($form) {
                var data = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    categories: $('#categories').val()
                };

                $submitButton.prop('disabled', true);

                $.post(saveSubscriberUrl, data, function() {
                    $('form')[0].reset();

                    showSuccess('Subscriber added successfully');

                    $submitButton.prop('disabled', false);
                });

                // stop submitting form
                return false;
            }
        });
    })
});
