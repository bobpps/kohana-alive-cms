/***** TABLE *****/

// Columns tab
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
    var alias = $('#currentAlias').val(),
            value = control.attr('type') == 'checkbox'
            ? control.is(':checked')
                ? 1 : 0
            : control.val(),
            fieldName = control.attr('name');
    
    ajax('change_column_param',
    {
        alias: alias,
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
// End columns tab


// Validation rules
$(function () {
    $('#validationRulesModal').on('click', 'input.rule-check', function () {
        var row = $(this).parents('.row');

        if ($(this).is(':checked')) {
            checkRulesRow(row, null);
        }
        else {
            uncheckRulesRow(row);
        }
    });

    $('.column-data').on('click', '.validation-rules', function () {
        validationRulesPopupOpen($(this));
        
        return false;
    });
    
    $('#validationRulesForm').submit(function(){
         return false;
    });
    
    $('#validationRulesApply').click(function(){
        var form = $('#validationRulesForm'),
            popup = $('#validationRulesModal'),
            renderTo = popup.data('column').find('.validation-rules-group'),
            popupContent = popup.find('.modal-body-content');
                
        ajax('change_validation_rules',
        form.serialize(),
        {
            beforeSend: function(){
                popupContent.html('');
                popupSetLoading('Сохранение...');
            },
            success: function(result){
                // Показываем новые кнопки
                renderTo.html(result.html);
            },
            complete: function(){
                $('#validationRulesModal').modal('hide');
                popupSetLoading();
            }
        });        
    });
});

function validationRulesPopupOpen(el){
    var popup = $('#validationRulesModal'),
        columnWrapper = el.parents('.column-data'),
        renderTo = popup.find('.modal-body-content');

    popup.modal();

    // При открытии popup-окна запоминаем столбец, из которого делаются изменения
    if(columnWrapper){
        popup.data('column', columnWrapper);
    }
    
    ajax('get_validation_rules_form',
    {
        column: columnWrapper.find('input[name=name]').val()
    },
    {
        beforeSend: function(){
            renderTo.html('');
            popupSetLoading('Загрузка...');
        },
        success: function(result){
            // Показываем HTML
            renderTo.html(result.html);
        },
        complete: function(){
            popupSetLoading();            
        }
    });     
}

function popupSetLoading(message){
    var popup = $('#validationRulesModal'),
        applyBtn = $('#validationRulesApply'),
        loading = popup.find('.loading');

    if(message){
        loading.show();
        loading.html(message);
        applyBtn.attr('disabled', true);        
    }
    else{
        loading.hide();
        loading.html('');
        applyBtn.attr('disabled', false);        
    }
}

function checkRulesRow(row) {
    row.addClass('checked');
    row.find('input.rule-check').prop('checked', true);
    row.find('input.rule-value')
            //.val(value)
            .attr('disabled', false);
}

function uncheckRulesRow(row) {
    row.removeClass('checked');
    row.find('input.rule-check').prop('checked', false);
    row.find('input.rule-value')
            //.val(null)
            .attr('disabled', true);
}
//End validation rules
/***** END TABLE *****/

/***** STRUCTURE *****/
$(function() {
    $('#structure select').change(function() {
        saveTableParamChanges($(this));
    });
    
    $('#structure input[type=text], #structure input[type=number]').inputeditor({
        applyBtnClass: 'btn-sm',
        cancelBtnClass: 'btn-sm',
        applyChanges: function(el) {
            saveTableParamChanges(el);
        }
    }); 
});

function saveTableParamChanges(el){
    var row = el.parents('.table-item'),
        alias = row.find('.alias').text(),
        fieldName = el.attr('name'),
        value = el.val();

    ajax('change_table_param',
    {
        alias: alias,
        field: fieldName,
        value: value
    },
    {
        beforeSend: function(){
            el.attr('disabled', true);
        },
        success: function(result){
            alert(result.msg);
        },
        complete: function(){
            el.attr('disabled', false);
        }
    });
}





