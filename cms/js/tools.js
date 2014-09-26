/***** TABLE *****/

$(function() {
    $('#columns input[type=checkbox], #columns select').change(function() {
        saveColumnParamChanges($(this));
    });
    
    $('#columns input[type=text], #columns input[type=number]').inputeditor({
        applyBtnClass: 'btn-sm',
        cancelBtnClass: 'btn-sm',
        applyChanges: function(el) {
            saveColumnParamChanges(el);
        }
    }); 

    $('#columns select.controls').controlselect({
        btnClass: 'btn-sm',
    });

    $('#columns .color-control').colorselect();    
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


