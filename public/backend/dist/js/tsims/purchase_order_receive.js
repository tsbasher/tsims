$(document).ready(function() {
    $('#supplier_id').change(function() {
        var supplier_id = $(this).val();
        debugger;
        url= get_purchase_order_by_supplier.replace('*', supplier_id);
        if (supplier_id) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    debugger;
                    $('#purchase_order_id').empty();
                    $('#purchase_order_id').append('<option value="">Select Workorder</option>');
                    $.each(data, function(key, value) {
                        debugger;
                        $('#purchase_order_id').append(`<option value="${value.id}">${value.po_number}</option>`);
                    });
                }
            });
        } else {
            $('#purchase_order_id').empty();
            $('#purchase_order_id').append('<option value="">Select Purchase Order</option>');
        }
        $('#purchase_order_id').select2();
    });
});
