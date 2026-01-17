$(document).ready(function() {
    $('#customer_id').change(function() {
        var customer_id = $(this).val();
        debugger;
        url= get_workorder_by_customer.replace('*', customer_id);
        if (customer_id) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    debugger;
                    $('#workorder_id').empty();
                    $('#workorder_id').append('<option value="">Select Workorder</option>');
                    $.each(data, function(key, value) {
                        debugger;
                        $('#workorder_id').append(`<option value="${value.id}">${value.order_number}</option>`);
                    });
                }
            });
        } else {
            $('#workorder_id').empty();
            $('#workorder_id').append('<option value="">Select Workorder</option>');
        }
        $('#workorder_id').select2();
    });
});
