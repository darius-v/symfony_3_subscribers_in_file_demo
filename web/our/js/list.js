$( document ).ready(function() {
    var table = $('.table').DataTable();

    $('[id^=delete]').on('click', function () {
        var url = $(this).attr('href');

        var $rowToRemove = $(this).closest('tr');

        $.ajax({
            url: url,
            type: 'DELETE',
            success: function () {
                table.row($rowToRemove).remove();
                table.draw();
            }
        });

        return false;
    })
});
