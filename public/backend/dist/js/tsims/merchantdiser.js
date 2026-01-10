$(document).ready(function() {
    $('#customer_id').change(function() {
        var customer_id = $(this).val();
        
        url= get_merchandiser_by_customer.replace('*', customer_id);
        if (customer_id) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    debugger;
                    $('#merchandiser_id').empty();
                    $('#merchandiser_id').append('<option value="">Select Merchandiser</option>');
                    $.each(data, function(key, value) {
                        $('#merchandiser_id').append(`<option value="${value.id}">${value.name}</option>`);
                    });
                }
            });
        } else {
            $('#merchandiser_id').empty();
            $('#merchandiser_id').append('<option value="">Select Merchandiser</option>');
        }
        $('#merchandiser_id').select2();
    });
});
