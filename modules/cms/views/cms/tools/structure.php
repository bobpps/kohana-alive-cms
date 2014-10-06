<div class="row" id="structure">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Найдены таблицы:
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-8 col-md-6 col-lg-4">
                        <div class="col-xs-2">
                            <input type="checkbox" />
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <label>Alias</label>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <label>Table name</label>
                            </div>                            
                        </div>
                    </div>                    

                    <div class="col-xs-4 col-md-3">
                        <div class="form-group">
                            <label>Название</label>
                        </div>
                    </div>  
                    <div class="hidden-xs hidden-sm col-md-3">
                        <div class="form-group">
                            <label>Раздел меню</label>
                        </div>
                    </div>
                    <div class="hidden-xs hidden-sm hidden-md col-lg-2">
                        <div class="form-group">
                            <label>Сортировка</label>
                        </div>
                    </div>                       
                </div>

                <div class="row table-item">
                    <div class="col-xs-8 col-md-6 col-lg-4">
                        <div class="col-xs-2">
                            <div class="text-field">
                                <input type="checkbox" />
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <div class="text-field">
                                    <a class="alias" href="<?= Cms_Urlmanager::get_tools_url('table', 'app_html_blocks') ?>">test_table</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <div class="text-field table-name">test_table</div>
                            </div>                            
                        </div>
                    </div>

                    <div class="col-xs-4 col-md-3">
                        <div class="form-group">
                            <?= Form::input('name', 'Тестовая таблица', array('class' => 'form-control input-sm', 'type' => 'text')) ?>
                        </div>
                    </div>  
                    <div class="hidden-xs hidden-sm col-md-3">
                        <div class="form-group">
                            <?= Form::select('menu', $sections, NULL, array('class' => 'form-control input-sm')) ?>
                        </div>
                    </div>
                    <div class="hidden-xs hidden-sm hidden-md col-lg-2">
                        <div class="form-group">
                            <?= Form::input('sorting', '100', array('class' => 'form-control input-sm', 'type' => 'number')) ?>
                        </div>
                    </div>                       
                </div>                 

                <div class="row table-item">
                    <div class="col-xs-8 col-md-6 col-lg-4">
                        <div class="col-xs-2">
                            <div class="text-field">
                                <input type="checkbox" />
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <div class="text-field">
                                    <a class="alias" href="<?= Cms_Urlmanager::get_tools_url('table', 'app_html_blocks') ?>">first_table</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <div class="text-field table-name">first_table</div>
                            </div>                            
                        </div>
                    </div>                    

                    <div class="col-xs-4 col-md-3">
                        <div class="form-group">
                            <?= Form::input('name', 'Таблица 1', array('class' => 'form-control input-sm', 'type' => 'text')) ?>
                        </div>
                    </div>  
                    <div class="hidden-xs hidden-sm col-md-3">
                        <div class="form-group">
                            <?= Form::select('menu', $sections, NULL, array('class' => 'form-control input-sm')) ?>
                        </div>
                    </div>
                    <div class="hidden-xs hidden-sm hidden-md col-lg-2">
                        <div class="form-group">
                            <?= Form::input('sorting', '100', array('class' => 'form-control input-sm', 'type' => 'number')) ?>
                        </div>
                    </div>                       
                </div>    

                <div class="row table-item">
                    <div class="col-xs-8 col-md-6 col-lg-4">
                        <div class="col-xs-2">
                            <div class="text-field">
                                <input type="checkbox" />
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <div class="text-field">
                                    <a class="alias" href="<?= Cms_Urlmanager::get_tools_url('table', 'app_html_blocks') ?>">second_table</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <div class="text-field table-name">second_table</div>
                            </div>                            
                        </div>
                    </div>                         
                    <div class="col-xs-4 col-md-3">
                        <div class="form-group">
                            <?= Form::input('name', 'Таблица 2', array('class' => 'form-control input-sm', 'type' => 'text')) ?>
                        </div>
                    </div>  
                    <div class="hidden-xs hidden-sm col-md-3">
                        <div class="form-group">
                            <?= Form::select('menu', $sections, NULL, array('class' => 'form-control input-sm')) ?>
                        </div>
                    </div>
                    <div class="hidden-xs hidden-sm hidden-md col-lg-2">
                        <div class="form-group">
                            <?= Form::input('sorting', '100', array('class' => 'form-control input-sm', 'type' => 'number')) ?>
                        </div>
                    </div>                       
                </div>                

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
