$( document ).ready(function() {

    $('#submit').on('click', function(e) {
        e.preventDefault();

        var data = {
            name: $('#name').val(),
            email: $('#email').val(),
            categories: $('#categories').val()
        };

        $.post(saveSubscriberUrl, data, function() {
            $('form')[0].reset();

            $('.alert-success').text('Subscriber added succesfully');

            $('.alert-success').fadeTo(2000, 500).slideUp(1000);
        });
    })
});