<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#params" role="tab" data-toggle="tab">Параметры</a></li>
    <li><a href="#columns_old" role="tab" data-toggle="tab">Столбцы</a></li>
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
                            <?=Form::input('order', '100', array('type' => 'number', 'class' => 'form-control', 'id' => 'order', 'placeholder' => 'Порядок вывода'))?>
                        </div>
                    </div>                  
                </div>  

                <div class="col-lg-6">
                    <div class="form-group">
                        <?=Form::label('width', 'Ширина', array('class' => 'col-sm-3 control-label'))?>
                        <div class="col-sm-9">
                            <?=Form::input('width', '', array('type' => 'number', 'class' => 'form-control', 'id' => 'width', 'placeholder' => 'Ширина'))?>
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
    <div class="tab-pane fade" id="columns_old">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 200px;">Название</th>
                    <th>Имя столбца</th>
                    <th>Редактор</th>
                    <th>Список</th>
                    <th>Не активен</th>
                    <th class="sort-number-column">Ширина</th>
                    <th>Цвет</th>
                    <th>Выравнивание</th>
                    <th class="sort-number-column">Редактор сортировка</th>
                    <th class="sort-number-column">Список сортировка</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
<!--                        <div class="input-display">
                            <a href="#" title="Редактировать">Id</a>
                        </div>
                        <div class="input-editor">
                            <?=Form::input('name', 'Id', array('class' => 'form-control input-sm', 'style' => 'width: 140px;'))?>
                            <a href="#" class="ok-button" title="Применить"><span style="color: green;" class="glyphicon glyphicon-ok-circle"></span></a>
                            <a href="#" class="cancel-button" title="Отменить"><span style="color: red;" class="glyphicon glyphicon-remove-circle"></span></a>                        
                        </div>-->
                        <?=Cms_Control::columneditor('name', 'Id', array('class' => 'form-control input-sm', 'style' => 'width: 140px;'))?>
                    </td>
                    <td>id</td>
                    <td>
                        <?=Form::select('edit', $edit_controls, 'Textbox', array('class' => 'form-control input-sm'))?>
                    </td>
                    <td>
                        <?=Form::select('list', $list_controls, 'Checkbox', array('class' => 'form-control input-sm'))?>
                    </td>
                    <td style="text-align: center;"><?=Form::checkbox('disabled', '1', FALSE)?></td>
                    <td style="text-align: center;">
<!--                        <div class="input-display">
                            <a href="#" title="Редактировать">0</a>
                        </div>
                        <div class="input-editor">
                            <?=Form::input('edit_width', '0', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                            <a href="#" class="ok-button" title="Применить"><span style="color: green;" class="glyphicon glyphicon-ok-circle"></span></a>
                            <a href="#" class="cancel-button" title="Отменить"><span style="color: red;" class="glyphicon glyphicon-remove-circle"></span></a>
                        </div>                        -->

                        <?=Cms_Control::columneditor('edit_width', '0', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                    </td>
                    <td>
                        <?=Form::select('color', $colors, 'Black', array('class' => 'form-control input-sm color-control'))?>
                    </td>
                    <td><?=Form::select('align', $align, 'Left', array('class' => 'form-control input-sm'))?></td>
                    <td style="text-align: center;">
<!--                        <div class="input-display">
                            <a href="#" title="Редактировать">100</a>
                        </div>
                        <div class="input-editor">
                            <?=Form::input('edit_sort', '100', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                            <a href="#" class="ok-button" title="Применить"><span style="color: green;" class="glyphicon glyphicon-ok-circle"></span></a>
                            <a href="#" class="cancel-button" title="Отменить"><span style="color: red;" class="glyphicon glyphicon-remove-circle"></span></a>
                        </div>-->

                        <?=Cms_Control::columneditor('edit_sort', '100', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                    </td>
                    <td style="text-align: center;">
<!--                        <div class="input-display">
                            <a href="#" title="Редактировать">100</a>
                        </div>
                        <div class="input-editor">
                            <?=Form::input('list_sort', '100', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                            <a href="#" class="ok-button" title="Применить"><span style="color: green;" class="glyphicon glyphicon-ok-circle"></span></a>
                            <a href="#" class="cancel-button" title="Отменить"><span style="color: red;" class="glyphicon glyphicon-remove-circle"></span></a>
                        </div>-->

                        <?=Cms_Control::columneditor('list_sort', '100', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
<!--                        <div class="input-display">
                            <a href="#" title="Редактировать">Id</a>
                        </div>
                        <div class="input-editor">
                            <?=Form::input('name', 'Name', array('class' => 'form-control input-sm', 'style' => 'width: 140px;'))?>
                            <a href="#" class="ok-button" title="Применить"><span style="color: green;" class="glyphicon glyphicon-ok-circle"></span></a>
                            <a href="#" class="cancel-button" title="Отменить"><span style="color: red;" class="glyphicon glyphicon-remove-circle"></span></a>                        
                        </div>-->
                        <?=Cms_Control::columneditor('name', 'Name', array('class' => 'form-control input-sm', 'style' => 'width: 140px;'))?>
                    </td>
                    <td>name</td>
                    <td>
                        <?=Form::select('edit', $edit_controls, 'Textbox', array('class' => 'form-control input-sm'))?>
                    </td>
                    <td>
                        <?=Form::select('list', $list_controls, '', array('class' => 'form-control input-sm'))?>
                    </td>
                    <td style="text-align: center;"><?=Form::checkbox('disabled', '1', FALSE)?></td>
                    <td style="text-align: center;">
<!--                        <div class="input-display">
                            <a href="#" title="Редактировать">0</a>
                        </div>
                        <div class="input-editor">
                            <?=Form::input('edit_width', '0', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                            <a href="#" class="ok-button" title="Применить"><span style="color: green;" class="glyphicon glyphicon-ok-circle"></span></a>
                            <a href="#" class="cancel-button" title="Отменить"><span style="color: red;" class="glyphicon glyphicon-remove-circle"></span></a>
                        </div>                        -->

                        <?=Cms_Control::columneditor('edit_width', '0', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                    </td>
                    <td>
                        <?=Form::select('color', $colors, 'Red', array('class' => 'form-control input-sm color-control'))?>
                    </td>
                    <td><?=Form::select('align', $align, 'Left', array('class' => 'form-control input-sm'))?></td>
                    <td style="text-align: center;">
<!--                        <div class="input-display">
                            <a href="#" title="Редактировать">100</a>
                        </div>
                        <div class="input-editor">
                            <?=Form::input('edit_sort', '100', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                            <a href="#" class="ok-button" title="Применить"><span style="color: green;" class="glyphicon glyphicon-ok-circle"></span></a>
                            <a href="#" class="cancel-button" title="Отменить"><span style="color: red;" class="glyphicon glyphicon-remove-circle"></span></a>
                        </div>-->

                        <?=Cms_Control::columneditor('edit_sort', '100', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                    </td>
                    <td style="text-align: center;">
<!--                        <div class="input-display">
                            <a href="#" title="Редактировать">100</a>
                        </div>
                        <div class="input-editor">
                            <?=Form::input('list_sort', '100', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                            <a href="#" class="ok-button" title="Применить"><span style="color: green;" class="glyphicon glyphicon-ok-circle"></span></a>
                            <a href="#" class="cancel-button" title="Отменить"><span style="color: red;" class="glyphicon glyphicon-remove-circle"></span></a>
                        </div>-->

                        <?=Cms_Control::columneditor('list_sort', '100', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                    </td>
                </tr>                
            </tbody>
        </table>
    </div>
    
    <!-- COLUMNS -->
    <div class="tab-pane fade" id="columns">
        <div class="row">
            <div class="col-sm-4">
                Столбец
            </div>
            <div class="col-sm-5">
                Редактор
            </div>            
            <div class="col-sm-3">
                Список
            </div> 
<!--        </div>
         
        <div class="row">-->
            <div class="col-sm-2">
                Имя столбца
            </div>
            <div class="col-sm-2">
                Название
            </div>
            <div class="col-sm-2">
                Контрол
            </div>
            <div class="col-sm-1">
                Сорт
            </div>            
            <div class="col-sm-2">
                Ограничения
            </div> 
            <div class="col-sm-2">
                Контрол
            </div>
            <div class="col-sm-1">
                Сорт
            </div>  
        </div> 
        
        <hr />
        
        <div class="row">
            <div class="col-sm-2">
                id
            </div>
            <div class="col-sm-2">
<!--                        <div class="input-display">
                            <a href="#" title="Редактировать">Id</a>
                        </div>
                        <div class="input-editor">
                            <?=Form::input('name', 'Id', array('class' => 'form-control input-sm', 'style' => 'width: 140px;'))?>
                            <a href="#" class="ok-button" title="Применить"><span style="color: green;" class="glyphicon glyphicon-ok-circle"></span></a>
                            <a href="#" class="cancel-button" title="Отменить"><span style="color: red;" class="glyphicon glyphicon-remove-circle"></span></a>                        
                        </div>-->
                        <?=Cms_Control::columneditor('name', 'Id', array('class' => 'form-control input-sm', 'style' => 'width: 140px;'))?>
            </div>
            <div class="col-sm-2">
                <?=Form::select('edit', $edit_controls, 'Textbox', array('class' => 'form-control input-sm'))?>
            </div>
            <div class="col-sm-1">
<!--                        <div class="input-display">
                            <a href="#" title="Редактировать">100</a>
                        </div>
                        <div class="input-editor">
                            <?=Form::input('edit_sort', '100', array('type' => 'number', 'style' => 'width: 65px;', 'class' => 'form-control input-sm'))?>
                            <a href="#" class="ok-button" title="Применить"><span style="color: green;" class="glyphicon glyphicon-ok-circle"></span></a>
                            <a href="#" class="cancel-button" title="Отменить"><span style="color: red;" class="glyphicon glyphicon-remove-circle"></span></a>
                        </div>-->

                        <?=Cms_Control::columneditor('edit_sort', '100', array('type' => 'number', 'class' => 'form-control input-sm'))?>
            </div>            
            <div class="col-sm-2">
    <div class="input-group">
      <?=Form::select('edit', $edit_controls, 'Textbox', array('class' => 'form-control input-sm'))?>
      <span class="input-group-btn">
        <button class="btn btn-default btn-sm" type="button"><span class="glyphicon glyphicon-cog"></span></button>
      </span>      
    </div>
            </div> 
            <div class="col-sm-2">
                Контрол
            </div>
            <div class="col-sm-1">
                Сорт
            </div>              
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.color-control').each(function(){
            $(this).css('color', $(this).val().toLowerCase())
        });
        $('.color-control option').css('color', function(){
            return $(this).text().toLowerCase();
        });
    });
</script>
