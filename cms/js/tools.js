/***** TABLE *****/

$(function() {
    $('#columns .input-display a').click(function() {
        var displayDiv = $(this).parents('.input-display'),
                editorDiv = displayDiv.next('.input-editor');

        editorDiv.children('input').val($(this).text());

        displayDiv.hide();
        editorDiv.show();

        editorDiv.children('input').focus();
        return false;
    });

    $('#columns .input-editor .cancel-button').click(function() {
        var editorDiv = $(this).parents('.input-editor'),
                displayDiv = editorDiv.prev('.input-display');

        editorDiv.hide();
        displayDiv.show();

        return false;
    });

    $('#columns .input-editor .ok-button').click(function() {
        var editorDiv = $(this).parents('.input-editor'),
                displayDiv = editorDiv.prev('.input-display'),
                input = editorDiv.find('input');

        if (input.val() && input.val() != displayDiv.children('a').text()) {
            saveColumnParamChanges(input);

            displayDiv.children('a').text(input.val());
        }

        editorDiv.hide();
        displayDiv.show();

        return false;
    });

    $('#columns input[type=checkbox], #columns select').change(function() {
        saveColumnParamChanges($(this));
    });
    
    $('.color-control').change(function(){
        $(this).css('color', $(this).val().toLowerCase());
    });
});

function saveColumnParamChanges(control) {
    var tableName = $('#tableName').val(),
            value = control.attr('type') == 'checkbox'
            ? control.is(':checked')
                ? 1 : 0
            : control.val(),
            fieldName = control.attr('name');
    
    ajax('change_column_param',
    {
        table: tableName,
        field: fieldName,
        value: value
    },
    {
        beforeSend: function(){
            control.attr('disabled', true);
        },
        success: function(result){
            alert(result.msg);
        },
        complete: function(){
            control.attr('disabled', false);
        }
    });
}


