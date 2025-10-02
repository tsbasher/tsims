$(document).ready(function() {
    $('#category_id').change(function() {
        var category_id = $(this).val();
        
        url= get_sub_category_by_category.replace('*', category_id);
        if (category_id) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    debugger;
                    $('#sub_category_id').empty();
                    $('#sub_category_id').append('<option value="">Select Sub Category</option>');
                    $.each(data, function(key, value) {
                        $('#sub_category_id').append(`<option value="${value.id}" >${value.name}</option>`);
                    });
                }
            });
        } else {
            $('#sub_category_id').empty();
            $('#sub_category_id').append('<option value="">Select Category</option>');
        }
        $('#sub_category_id').select2();
    });
});
