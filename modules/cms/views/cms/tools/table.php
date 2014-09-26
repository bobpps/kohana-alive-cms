

<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#params" role="tab" data-toggle="tab">Параметры</a></li>
    <li><a href="#columns" role="tab" data-toggle="tab">Столбцы</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <!-- PARAMS -->
    <div class="tab-pane fade in active" id="params">
        <form class="form-horizontal" role="form" method="post" action="">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <?=Form::label('tableName', 'Имя таблицы', array('class' => 'col-sm-3 control-label'))?>
                        <div class="col-sm-9">
                            <?=Form::input('table_name', 'test_table', array('type' => 'text', 'class' => 'form-control', 'id' => 'tableName', 'disabled' => 'disabled'))?>
                        </div>
                    </div>                  
                </div>  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?=Form::label('alias', 'Псевдоним', array('class' => 'col-sm-3 control-label'))?>
                        <div class="col-sm-9">
                            <?=Form::input('alias', '', array('type' => 'text', 'class' => 'form-control', 'id' => 'alias'))?>
                        </div>
                    </div>                  
                </div>                  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?=Form::label('name', 'Название', array('class' => 'col-sm-3 control-label'))?>
                        <div class="col-sm-9">
                            <?=Form::input('name', 'Test table', array('type' => 'text', 'class' => 'form-control', 'id' => 'name', 'required' => 'required'))?>
                        </div>
                    </div>                  
                </div>  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?=Form::label('access', 'Доступ', array('class' => 'col-sm-3 control-label'))?>
                        <div class="col-sm-9">
                            <?=Form::select('access', $users, NULL, array('class' => 'form-control', 'id' => 'access'))?>
                        </div>
                    </div>                  
                </div>                  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?=Form::label('IDColumn', 'ID column', array('class' => 'col-sm-3 control-label'))?>
                        <div class="col-sm-9">
                            <?=Form::select('id_column', $columns, NULL, array('class' => 'form-control', 'id' => 'IDColumn'))?>
                        </div>
                    </div>                  
                </div>  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?=Form::label('isActiveColumn', 'ON/OFF column', array('class' => 'col-sm-3 control-label'))?>
                        <div class="col-sm-9">
                            <?=Form::select('is_active_column', $columns, NULL, array('class' => 'form-control', 'id' => 'isActiveColumn'))?>
                        </div>
                    </div>                  
                </div>                  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?=Form::label('sortOrderColumn', 'SO column', array('class' => 'col-sm-3 control-label'))?>
                        <div class="col-sm-9">
                            <?=Form::select('sort_order_column', $columns, NULL, array('class' => 'form-control', 'id' => 'sortOrderColumn'))?>
                        </div>
                    </div>                  
                </div>  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?=Form::label('menuSection', 'Раздел меню', array('class' => 'col-sm-3 control-label'))?>
                        <div class="col-sm-9">
                            <?=Form::select('menu_section', $sections, NULL, array('class' => 'form-control', 'id' => 'menuSection'))?>
                        </div>
                    </div>                  
                </div>                  
            </div>            

            <hr />      

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <?=Form::label('order', 'Порядок вывода', array('class' => 'col-sm-3 control-label'))?>
                        <div class="col-sm-9">
                            <?=Form::input('order', '100', array('type' => 'number', 'class' => 'form-control', 'id' => 'order'))?>
                        </div>
                    </div>                  
                </div>  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?=Form::label('width', 'Ширина', array('class' => 'col-sm-3 control-label'))?>
                        <div class="col-sm-9">
                            <?=Form::input('width', '', array('type' => 'number', 'class' => 'form-control', 'id' => 'width'))?>
                        </div>
                    </div>                  
                </div>   
            </div>

            <hr />

            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <?=Form::input('adding', '1', array('type' => 'checkbox'))?>
                                Разрешить добавление
                            </label>
                        </div>

                    </div>                   
                </div> 

                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">

                        <div class="checkbox">
                            <label>
                                <?=Form::input('removing', '1', array('type' => 'checkbox'))?>
                                Разрешить удаление
                            </label>
                        </div>

                    </div>                     
                </div>   

                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <?=Form::input('editing', '1', array('type' => 'checkbox'))?>
                                Разрешить редактирование
                            </label>
                        </div>

                    </div>                   
                </div> 

                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">

                        <div class="checkbox">
                            <label>
                                <?=Form::input('search', '1', array('type' => 'checkbox'))?>
                                Поиск
                            </label>
                        </div>

                    </div>                     
                </div>                   
            </div>

            <hr />  

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?=Form::label('orderBy', 'ORDER BY', array('class' => 'control-label'))?>
                        <?=Form::input('order_by', '', array('type' => 'text', 'class' => 'form-control', 'id' => 'orderBy', 'placeholder' => 'ORDER BY'))?>
                    </div>                  
                </div>  
                <div class="col-lg-12">
                    <div class="form-group">
                        <?=Form::label('where', 'WHERE', array('class' => 'control-label'))?>
                        <?=Form::input('where', '', array('type' => 'text', 'class' => 'form-control', 'id' => 'where', 'placeholder' => 'WHERE'))?>
                    </div>                  
                </div>                 
            </div>

            <hr />
            
            <input name="apply" value="0" type="hidden" />
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"> </span> &nbsp; Сохранить</button>
            <button type="submit" class="btn btn-info" onClick="javascript: $('input[name=apply]').val(1);"><span class="glyphicon glyphicon-floppy-saved"> </span> &nbsp; Применить</button>            
            <a href="/" class="btn btn-default">Отмена</a>

        </form>        
    </div>
    
    <!-- COLUMNS -->
    <div class="tab-pane fade" id="columns">
        <div class="column-data">
            <div class="row">
                <div class="col-xs-6 col-lg-4">
                    <span style="font-size: 24px;">[ id ]</span>
                </div>            
                <div class="col-xs-6 col-lg-3">
                    <!--<?=Cms_Control::columneditor('name', 'Id', array('class' => 'form-control input-sm'))?>-->
                    <?=Form::input('name', 'Id', array('class' => 'form-control input-sm'))?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-lg-1" style="font-weight: bold;">
                    Редактор:
                </div>            
                <div class="col-xs-6 col-lg-3">
                    <?=Form::select('edit', $edit_controls, 'Textbox', array('class' => 'form-control input-sm controls'))?>
                </div>
                <div class="col-xs-6 col-lg-3">
                    <?=Form::input('edit_sort', '100', array('type' => 'number', 'class' => 'form-control input-sm'))?>
                </div>
                <div class="col-xs-12 col-lg-5">
                    <div class="row">
                        <div class="col-xs-6 col-lg-4">
                            <a href="#" class="validation-rules">Валидация:</a>
                        </div>  
                        <div class="col-xs-6 col-lg-8">
                            <div class="btn-group validation-rules-group">
                                <button class="btn btn-default btn-sm validation-rules" type="button" title="Required">R</button>
                                <button class="btn btn-default btn-sm validation-rules" type="button" data-value="255" title="Max length: 255">ML</button>
                                <button class="btn btn-default btn-sm validation-rules" type="button" data-value="\d [0-9]" title="RegEx (pattern): \d [0-9]">RE</button>
                                <button class="btn btn-default btn-sm validation-rules" type="button" data-value="10" title="Min: 10">Max</button>
                                <button class="btn btn-default btn-sm validation-rules" type="button" data-value="20" title="Max: 20">Min</button>

                            </div>   
                        </div>
                    </div>
                </div>             
            </div>
            <div class="row">
                <div class="col-xs-12 col-lg-1" style="font-weight: bold;">
                    Список:
                </div>            
                <div class="col-xs-6 col-lg-3">
                    <?=Form::select('list', $list_controls, '', array('class' => 'form-control input-sm controls'))?>
                </div>
                <div class="col-xs-6 col-lg-3">
                    <?=Form::input('list_sort', '200', array('type' => 'number', 'class' => 'form-control input-sm'))?>
                </div>
                <div class="col-xs-12 col-lg-5">
                    <div class="row">
                        <div class="hidden-sm hidden-xs hidden-md col-lg-4">
                            Color&nbsp;&&nbsp;Align:
                        </div>  
                        <div class="col-xs-6 col-lg-4">
                            <?=Form::select('color', $colors, 'Navy', array('class' => 'form-control input-sm color-control'))?>
                        </div>
                        <div class="col-xs-6 col-lg-4">
                            <?=Form::select('align', $align, 'Left', array('class' => 'form-control input-sm'))?>
                        </div>                    
                    </div>
                </div>      
            </div>   
        </div>
        
        <hr />
         
        <div class="column-data">
            <div class="row">
                <div class="col-xs-6 col-lg-4">
                    <span style="font-size: 24px;">[ name ]</span>
                </div>            
                <div class="col-xs-6 col-lg-3">
                    <?=Form::input('name', 'Название', array('class' => 'form-control input-sm'))?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-lg-1" style="font-weight: bold;">
                    Редактор:
                </div>            
                <div class="col-xs-6 col-lg-3">
                    <?=Form::select('edit', $edit_controls, 'Textbox', array('class' => 'form-control input-sm controls'))?>
                </div>
                <div class="col-xs-6 col-lg-3">
                    <?=Form::input('edit_sort', '100', array('type' => 'number', 'class' => 'form-control input-sm'))?>
                </div>
                <div class="col-xs-12 col-lg-5">
                    <div class="row">
                        <div class="col-xs-6 col-lg-4">
                            <a href="#" class="validation-rules">Валидация:</a>
                        </div>  
                        <div class="col-xs-6 col-lg-8">
                            <div class="btn-group validation-rules-group">
                                <button class="btn btn-default btn-sm validation-rules" type="button" title="Required">R</button>
<!--                                <button class="btn btn-default btn-sm validation-rules" type="button" data-value="255" title="Max length: 255">ML</button>
                                <button class="btn btn-default btn-sm validation-rules" type="button" data-value="\d [0-9]" title="RegEx (pattern): \d [0-9]">RE</button>-->
                                <button class="btn btn-default btn-sm validation-rules" type="button" data-value="10" title="Min: 10">Max</button>
                                <button class="btn btn-default btn-sm validation-rules" type="button" data-value="20" title="Max: 20">Min</button>
                            </div>   
                        </div>
                    </div>
                </div>             
            </div>
            <div class="row">
                <div class="col-xs-12 col-lg-1" style="font-weight: bold;">
                    Список:
                </div>            
                <div class="col-xs-6 col-lg-3">
                    <?=Form::select('list', $list_controls, '', array('class' => 'form-control input-sm controls'))?>
                </div>
                <div class="col-xs-6 col-lg-3">
                    <?=Form::input('list_sort', '200', array('type' => 'number', 'class' => 'form-control input-sm'))?>
                </div>
                <div class="col-xs-12 col-lg-5">
                    <div class="row">
                        <div class="hidden-sm hidden-xs hidden-md col-lg-4">
                            Color&nbsp;&&nbsp;Align:
                        </div>  
                        <div class="col-xs-6 col-lg-4">
                            <?=Form::select('color', $colors, 'Maroon', array('class' => 'form-control input-sm color-control'))?>
                        </div>
                        <div class="col-xs-6 col-lg-4">
                            <?=Form::select('align', $align, 'Left', array('class' => 'form-control input-sm'))?>
                        </div>                    
                    </div>
                </div>      
            </div>  
        </div>
    </div>    
</div>

<!-- Modal Validation Rules -->
<div class="modal fade" id="validationRulesModal" tabindex="-1" role="dialog" aria-labelledby="validationRulesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="validationRulesModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="row" data-code="R">
                    <div class="col-xs-6">
                        <input class="rule-check" type="checkbox" /> &nbsp;&nbsp;
                        <strong>Required</strong>
                    </div>
                </div>
                <div class="row" data-code="ML">
                    <div class="col-xs-6">
                        <input class="rule-check" type="checkbox" /> &nbsp;&nbsp;
                        <strong>Max length:</strong>
                    </div>
                    <div class="col-xs-6">
                        <input class="form-control input-sm rule-value" type="number" />
                    </div>
                </div>    
                <div class="row" data-code="RE">
                    <div class="col-xs-6">
                        <input class="rule-check" type="checkbox" /> &nbsp;&nbsp;
                        <strong>RegExp:</strong>
                    </div>
                    <div class="col-xs-6">
                        <input class="form-control input-sm rule-value" type="text" />
                    </div>
                </div>  
                <div class="row" data-code="Max">
                    <div class="col-xs-6">
                        <input class="rule-check" type="checkbox" /> &nbsp;&nbsp;
                        <strong>Max:</strong>
                    </div>
                    <div class="col-xs-6">
                        <input class="form-control input-sm rule-value" type="number" />
                    </div>
                </div>   
                <div class="row" data-code="Min">
                    <div class="col-xs-6">
                        <input class="rule-check" type="checkbox" /> &nbsp;&nbsp;
                        <strong>Min:</strong>
                    </div>
                    <div class="col-xs-6">
                        <input class="form-control input-sm rule-value" type="number" />
                    </div>
                </div>                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#validationRulesModal input.rule-check').click(function(){
            var row = $(this).parents('.row');
            
            if($(this).is(':checked')){
                checkRulesRow(row, null);
            }
            else{
                uncheckRulesRow(row);
            }
        });
        
        $('.validation-rules').click(function(){
            // Сбрасываем все в исходное состояние
            $('#validationRulesModal input.rule-check').prop('checked', false);
            $('#validationRulesModal input.rule-value')
                    .val(null)
                    .attr('disabled', true);
            $('#validationRulesModal div.row').removeClass('checked');

            // Устанавливаем текущие значения
            var buttons = $(this).parents('.column-data').find('.validation-rules-group .validation-rules');
            
            $.each(buttons, function(index, value){
                var btn = $(value),
                    ruleCode = btn.text(),
                    row = $('#validationRulesModal div.row[data-code='+ruleCode+']');
                    
                if(row){
                    checkRulesRow(row, btn.data('value'));
                    row.find('input.rule-value').val(btn.data('value'));
                }
            });
            
            $('#validationRulesModal').modal();
        });
    });
    
    function checkRulesRow(row){
        row.addClass('checked');
        row.find('input.rule-check').prop('checked', true);
        row.find('input.rule-value')
                //.val(value)
                .attr('disabled', false);        
    }
    
    function uncheckRulesRow(row){
        row.removeClass('checked');
        row.find('input.rule-check').prop('checked', false);
        row.find('input.rule-value')
                //.val(null)
                .attr('disabled', true);        
    }    
</script>
