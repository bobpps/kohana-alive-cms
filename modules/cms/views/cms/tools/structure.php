<div class="row" id="structure">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Найдены таблицы:
                <div class="pull-right btn-group header-btn">
                    <button id="exportBtn" type="button" class="btn btn-default" title="Экспорт">
                        <span class="fa fa-download"></span>
                    </button>
                    <button id="removeBtn" type="button" class="btn btn-default" title="Удалить">
                        <span class="fa fa-trash-o"></span>
                    </button>                
                </div>                
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">

                <div class="row table-header">
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

                <?php foreach ($tables as $table) : /* @var $table Cms_Structure*/ ?>
                <div class="row table-item">
                    <div class="col-xs-8 col-md-6 col-lg-4">
                        <div class="col-xs-2">
                            <div class="text-field">
                                <input type="checkbox" name="<?=$table->get_alias()?>" />
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <div class="text-field">
                                    <!--<span data-toggle="tooltip" data-placement="top" title="Tooltip on top" style="color: green;" class="fa fa-check"> </span>--> 
                                    <?=$table->get_option('structure-tooltip');?>
                                    <a class="alias" href="<?= Cms_Urlmanager::get_tools_url('table', $table->get_alias()) ?>"><?=$table->get_alias()?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <div class="text-field table-name"><?=$table->get_table_name()?></div>
                            </div>                            
                        </div>
                    </div>

                    <div class="col-xs-4 col-md-3">
                        <div class="form-group">
                            <?= Form::input('name', $table->get_option('name'), array('class' => 'form-control input-sm', 'type' => 'text')) ?>
                        </div>
                    </div>  
                    <div class="hidden-xs hidden-sm col-md-3">
                        <div class="form-group">
                            <?= Form::select('menu_section', $sections, $table->get_option('menu_section'), array('class' => 'form-control input-sm')) ?>
                        </div>
                    </div>
                    <div class="hidden-xs hidden-sm hidden-md col-lg-2">
                        <div class="form-group">
                            <?= Form::input('order', $table->get_option('order'), array('class' => 'form-control input-sm', 'type' => 'number')) ?>
                        </div>
                    </div>                       
                </div>                  
                <?php endforeach; ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <button id="importBtn" type="button" class="btn btn-default pull-right">
            <span class="fa fa-upload fa-fw"></span> 
            Импорт
        </button>
        <a id="syncBtn" href="<?=Cms_Urlmanager::get_tools_url('sync')?>" class="btn btn-default" title="Синхронизировать">
            <span class="fa fa-exchange"></span>
            Синхронизация
        </a> 
        

        <?php if(count($tables_to_add) > 0) : ?>
        <div class="panel panel-default" style="margin-top: 30px;">
            <div class="panel-heading">
                Найдены новые таблицы:
            </div>  
            <div class="panel-body">
                <div class="row">
                    <?php foreach ($tables_to_add as $tname): ?>
                    <div class="col-xs-12">
                        <p><?=$tname?></p>
                    </div>                     
                    <?php endforeach; ?>
                </div>                 
            </div>
        </div>
        <?php endif; ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
