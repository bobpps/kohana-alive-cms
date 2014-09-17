<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Найдены таблицы:
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="">Название</th>
                                <th class="">Имя таблицы</th>
                                <th class="menu-section-column">Раздел меню</th>
                                <th class="sort-number-column">Сотрировка</th>
                                <th class="button-edit-column">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>HTML блоки</td>
                                <td>app_html_blocks</td>
                                <td><?=Form::select('menu', array('Не выбрано', 'Каталог'), NULL, array('class' => 'form-control'))?></td>
                                <td><?=Form::input('sorting', '100', array('type' => 'number'))?></td>
                                <td><a href="#" class="btn btn-warning">Редактирование</a></td>
                            </tr>
                            <tr>
                                <td>Товары</td>
                                <td>catalog_product</td>
                                <td><?=Form::select('menu', array('Не выбрано', 'Каталог'), NULL, array('class' => 'form-control'))?></td>
                                <td><?=Form::input('sorting', '100', array('type' => 'number'))?></td>
                                <td><a href="#" class="btn btn-warning">Редактирование</a></td>
                            </tr>
                            <tr>
                                <td>Разделы каталога</td>
                                <td>catalog_section</td>
                                <td><?=Form::select('menu', array('Не выбрано', 'Каталог'), NULL, array('class' => 'form-control'))?></td>
                                <td><?=Form::input('sorting', '100', array('type' => 'number'))?></td>
                                <td><a href="#" class="btn btn-warning">Редактирование</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
