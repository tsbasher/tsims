$(document).ready(function() {
    $('#group_id').change(function() {
        var group_id = $(this).val();
        
        url= get_category_by_group.replace('*', group_id);
        if (group_id) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    debugger;
                    $('#category_id').empty();
                    $('#category_id').append('<option value="">Select Category</option>');
                    $.each(data, function(key, value) {
                        $('#category_id').append(`<option value="${value.id}" >${value.name}</option>`);
                    });
                }
            });
        } else {
            $('#category_id').empty();
            $('#category_id').append('<option value="">Select Category</option>');
        }
        $('#category_id').select2();
    });
});
