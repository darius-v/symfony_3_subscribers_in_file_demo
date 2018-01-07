$( document ).ready(function() {
    var table = $('.table').DataTable();

    function Deleter(table) {
        var $rowToRemove = null;
        var url = null;

        function runDeleteRequest() {
            $.ajax({
                url: url,
                type: 'DELETE',
                success: function () {
                    table.row($rowToRemove).remove();
                    table.draw();
                }
            });
        }

        $('[id^=delete]').on('click', function () {
            url = $(this).attr('href');

            $rowToRemove = $(this).closest('tr');

            $('#confirm-modal').modal('show');

            return false;
        });

        $('#confirm-yes').on('click', function () {

            runDeleteRequest();

            $('#confirm-modal').modal('hide');
        });
    }

    var deleter = new Deleter(table);

});
