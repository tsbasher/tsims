$(document).ready(function() {
    $('#customer_id').change(function() {
        var customer_id = $(this).val();
        debugger;
        url= get_style_by_customer.replace('*', customer_id);
        if (customer_id) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    debugger;
                    $('#style_id').empty();
                    $('#style_id').append('<option value="">Select Style</option>');
                    $.each(data, function(key, value) {
                        $('#style_id').append(`<option value="${value.id}">${value.code}-${value.name}</option>`);
                    });
                }
            });
        } else {
            $('#style_id').empty();
            $('#style_id').append('<option value="">Select Style</option>');
        }
        $('#style_id').select2();
    });
});
