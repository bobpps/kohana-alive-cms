<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#params" role="tab" data-toggle="tab">Параметры</a></li>
    <li><a href="#columns" role="tab" data-toggle="tab">Столбцы</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <!-- PARAMS -->
    <div class="tab-pane fade in active" id="params">
        <form class="form-horizontal" role="form" method="post" action="<?=  Cms_Urlmanager::get_tools_url('save')?>">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <?= Form::label('tableName', 'Имя таблицы', array('class' => 'col-sm-3 control-label')) ?>
                        <div class="col-sm-9">
                            <?= Form::input('table_name_fake', $table['table_name'], array('type' => 'text', 'class' => 'form-control', 'disabled' => 'disabled')) ?>
                            <?= Form::input('table_name', $table['table_name'], array('type' => 'hidden', 'id' => 'tableName')) ?>
                            <?= Form::input('current_alias', $table['alias'], array('type' => 'hidden', 'id' => 'currentAlias')) ?>
                        </div>
                    </div>                  
                </div>  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?= Form::label('alias', 'Псевдоним', array('class' => 'col-sm-3 control-label')) ?>
                        <div class="col-sm-9">
                            <?= Form::input('alias', $table['alias'], array('type' => 'text', 'class' => 'form-control', 'id' => 'alias')) ?>
                        </div>
                    </div>                  
                </div>                  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?= Form::label('name', 'Название', array('class' => 'col-sm-3 control-label')) ?>
                        <div class="col-sm-9">
                            <?= Form::input('name', $table['name'], array('type' => 'text', 'class' => 'form-control', 'id' => 'name', 'required' => 'required')) ?>
                        </div>
                    </div>                  
                </div>  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?= Form::label('access', 'Доступ', array('class' => 'col-sm-3 control-label')) ?>
                        <div class="col-sm-9">
                            <?= Form::select('access', $users, $table['access'], array('class' => 'form-control', 'id' => 'access')) ?>
                        </div>
                    </div>                  
                </div>                  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?= Form::label('IDColumn', 'ID column', array('class' => 'col-sm-3 control-label')) ?>
                        <div class="col-sm-9">
                            <?= Form::select('id_column', $columns, $table['id_column'], array('class' => 'form-control', 'id' => 'IDColumn')) ?>
                        </div>
                    </div>                  
                </div>  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?= Form::label('isActiveColumn', 'ON/OFF column', array('class' => 'col-sm-3 control-label')) ?>
                        <div class="col-sm-9">
                            <?= Form::select('is_active_column', $columns, $table['is_active_column'], array('class' => 'form-control', 'id' => 'isActiveColumn')) ?>
                        </div>
                    </div>                  
                </div>                  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?= Form::label('sortOrderColumn', 'SO column', array('class' => 'col-sm-3 control-label')) ?>
                        <div class="col-sm-9">
                            <?= Form::select('sort_order_column', $columns, $table['sort_order_column'], array('class' => 'form-control', 'id' => 'sortOrderColumn')) ?>
                        </div>
                    </div>                  
                </div>  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?= Form::label('menuSection', 'Раздел меню', array('class' => 'col-sm-3 control-label')) ?>
                        <div class="col-sm-9">
                            <?= Form::select('menu_section', $sections, $table['menu_section'], array('class' => 'form-control', 'id' => 'menuSection')) ?>
                        </div>
                    </div>                  
                </div>                  
            </div>            

            <hr />      

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <?= Form::label('order', 'Порядок вывода', array('class' => 'col-sm-3 control-label')) ?>
                        <div class="col-sm-9">
                            <?= Form::input('order', $table['order'], array('type' => 'number', 'class' => 'form-control', 'id' => 'order')) ?>
                        </div>
                    </div>                  
                </div>  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?= Form::label('width', 'Ширина', array('class' => 'col-sm-3 control-label')) ?>
                        <div class="col-sm-9">
                            <?= Form::input('width', $table['width'], array('type' => 'number', 'class' => 'form-control', 'id' => 'width')) ?>
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
                                <?= Form::checkbox('adding', '1', $table['adding']) ?>
                                Разрешить добавление
                            </label>
                        </div>

                    </div>                   
                </div> 

                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">

                        <div class="checkbox">
                            <label>
                                <?= Form::checkbox('removing', '1', $table['removing']) ?>
                                Разрешить удаление
                            </label>
                        </div>

                    </div>                     
                </div>   

                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <?= Form::checkbox('editing', '1', $table['editing']) ?>
                                Разрешить редактирование
                            </label>
                        </div>

                    </div>                   
                </div> 

                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">

                        <div class="checkbox">
                            <label>
                                <?= Form::checkbox('search', '1', $table['search']) ?>
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
                        <?= Form::label('orderBy', 'ORDER BY', array('class' => 'control-label')) ?>
                        <?= Form::input('order_by', $table['order_by'], array('type' => 'text', 'class' => 'form-control', 'id' => 'orderBy', 'placeholder' => 'ORDER BY')) ?>
                    </div>                  
                </div>  
                <div class="col-lg-12">
                    <div class="form-group">
                        <?= Form::label('where', 'WHERE', array('class' => 'control-label')) ?>
                        <?= Form::input('where', $table['where'], array('type' => 'text', 'class' => 'form-control', 'id' => 'where', 'placeholder' => 'WHERE')) ?>
                    </div>                  
                </div>                 
            </div>

            <hr />

            <input name="apply" value="0" type="hidden" />
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"> </span> &nbsp; Сохранить</button>
            <button type="submit" class="btn btn-info" onClick="javascript: $('input[name=apply]').val(1);"><span class="glyphicon glyphicon-floppy-saved"> </span> &nbsp; Применить</button>            
            <a href="<?=Cms_Urlmanager::get_tools_url('structure')?>" class="btn btn-default">Отмена</a>
        </form>        
    </div>

    <!-- COLUMNS -->
    <div class="tab-pane fade" id="columns">
        
        <?php foreach($table['columns'] as $column_name => $column) : ?>
        <div class="column-data" data-name="<?=$column_name?>">
            <div class="row">
                <div class="col-xs-6 col-lg-4">
                    <span style="font-size: 24px;">[ <?=$column_name?> ]</span>
                </div>            
                <div class="col-xs-6 col-lg-3">
                    <?= Form::input('name', $column['name'], array('class' => 'form-control input-sm')) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-lg-1" style="font-weight: bold;">
                    Редактор:
                </div>            
                <div class="col-xs-6 col-lg-3">
                    <?= Form::select('edit', $edit_controls, $column['edit'], array('class' => 'form-control input-sm controls', 'data-editable-items' => $edit_controls_editable)) ?>
                </div>
                <div class="col-xs-6 col-lg-3">
                    <?= Form::input('edit_sort', $column['edit_sort'], array('type' => 'number', 'class' => 'form-control input-sm')) ?>
                </div>
                <div class="col-xs-12 col-lg-5">
                    <div class="row">
                        <div class="col-xs-6 col-lg-4">
                            <a href="#" class="validation-rules">Валидация:</a>
                        </div>  
                        <div class="col-xs-6 col-lg-8">
                            <div class="btn-group validation-rules-group">
                                <?= $validation_rules[$column_name] ?>
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
                    <?= Form::select('list', $list_controls, $column['list'], array('class' => 'form-control input-sm controls', 'data-editable-items' => $list_controls_editable))
                    ?>
                </div>
                <div class="col-xs-6 col-lg-3">
                    <?= Form::input('list_sort', $column['list_sort'], array('type' => 'number', 'class' => 'form-control input-sm')) ?>
                </div>
                <div class="col-xs-12 col-lg-5">
                    <div class="row">
                        <div class="hidden-sm hidden-xs hidden-md col-lg-4">
                            Color&nbsp;&&nbsp;Align:
                        </div>  
                        <div class="col-xs-6 col-lg-4">
                            <?= Form::select('color', $colors, $column['color'], array('class' => 'form-control input-sm color-control')) ?>
                        </div>
                        <div class="col-xs-6 col-lg-4">
                            <?= Form::select('align', $align, $column['align'], array('class' => 'form-control input-sm')) ?>
                        </div>                    
                    </div>
                </div>      
            </div>   
        </div>
        
        <hr />
        <?php endforeach; ?>
    </div>    
</div>

<!-- Modal Validation Rules -->
<div class="modal fade" id="validationRulesModal" tabindex="-1" role="dialog" aria-labelledby="validationRulesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="validationRulesForm" action="" method="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
                    <h4 class="modal-title">Правила валидации</h4>
                </div>
                <div class="modal-body">
                    <div class="loading"> </div>
                    <div class="modal-body-content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" id="validationRulesApply" class="btn btn-primary">Применить</button>
                </div>
            </form>                
        </div>
    </div>
</div>

<script>

</script>
