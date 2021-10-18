$(document).ready(function() {
    $('.tab-content-addingNewEntry').submit(function(event) {
        event.preventDefault();

        var that = $(this),
        url = that.attr('action'),
        method = that.attr('method'),
        form_data = $(this).serialize();
        $.ajax({
            url: url,
            type: method,
            data: form_data,
            cache: false,
            success: function(date) {
                //if($('.Dish_Reset_ID_Delete').val()!= null)
                // that.parent().remove();
                alert(date);
            }
        });
    });
});