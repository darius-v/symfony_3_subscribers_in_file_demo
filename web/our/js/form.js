$( document ).ready(function() {

    var $submitButton = $('#submit-button');

    $submitButton.prop('disabled', false);

    function showSuccess(text) {
        var $alertSuccess = $('.alert-success');
        $alertSuccess.text(text);
        $alertSuccess.fadeTo(2000, 500).slideUp(1000);
    }

    function clearForm() {
        $('#id').val('');
        $('#name').val('');
        $('#email').val('');
        $('#categories option').prop('selected', false);
    }

    function isEditMode() {
        return $('#id').val();
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
                    id: $('#id').val(),
                    categories: $('#categories').val(),
                    token: $('#token').val()
                };

                $submitButton.prop('disabled', true);

                $.post(saveSubscriberUrl, data, function() {

                    if (!isEditMode()) {
                        clearForm();
                    }

                    showSuccess('Subscriber saved successfully');

                    $submitButton.prop('disabled', false);
                });

                // stop submitting form
                return false;
            }
        });
    })
});
