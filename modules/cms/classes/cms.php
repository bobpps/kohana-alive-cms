<?php

class Cms {
    
    const ACCESS_USER = 0;
    const ACCESS_ADMIN = 1;
    const ACCESS_SUPERADMIN = 2;
    
    const STRUCTURE_PATH = 'cms/structure';
    const STRUCTURE_FILE_EXT = 'table';
    
    public static $config = array(
        'table_config' => array(
            'access' => CMS::ACCESS_USER,
            'id_column' => 'id',
            'is_active_column' => NULL,
            'sort_order_column' => NULL,
            'menu_section' => NULL,
            'order' => 100,
            'width' => 0,
            'adding' => TRUE,
            'removing' => TRUE,
            'editing' => TRUE,
            'search' => TRUE,
            'order_by' => '',
            'where' => '', 
            'columns' => array()   
        ),
        'names_mapping' => array(
            'pages' => 'Страницы',
            'news'  => 'Новости',
            'settings' => 'Настройки',
            'gallery' => 'Галерея',
            'catalog' => 'Каталог',
            'catalogue' => 'Каталог',
        ),
        'special_columns' => array(
            'id' => array('id'),
            'is_active' => array('is_active', 'active'),
            'sorting' => array('sort_order', 'sort', 'sortorder', 'sort_no', 'sortno')
        ),
        'default_column' => array(
            'edit' => 'Hidden',
            'edit_sort' => 100,
            'list' => 'Hidden',
            'list_sort' => 100,
            'color' => 'Auto',
            'align' => 'Left',
            'validation_rules' => array()      
        ),
        'columns_mapping' => array(
            array(
                'matching' => array(
                    //'type' => '#^(string|int)$#i',
                    'is_nullable' => 1
                ),
                'through' => TRUE,
                'data' => array('validation_rules' => array('required' => ''))
            ),
            array(
                'matching' => array(
                    'type' => 'string'
                ),
                'through' => TRUE,
                'data' => array('validation_rules' => array('maxlength' => ':character_maximum_length'))
            ),            
            array(
                'matching' => array(
                    'column_name' => 'id'
                ),
                'through' => FALSE,
                'data' => array(
                    'name' => 'ID',
                    'edit' => 'Textbox',
                    'edit_sort' => 1,
                    'list' => 'Hidden',
                    'list_sort' => 10,                    
                )
            ),            
            array(
                'matching' => array(
                    'column_name' => 'name'
                ),
                'through' => FALSE,
                'data' => array(
                    'name' => 'Название',
                    'edit' => 'Textbox',
                    'edit_sort' => 10,
                    'list' => 'String',
                    'list_sort' => 10,                    
                )
            ),
        )
    );    
    
    
    /**
     * @return \Cms_iDal
     */
    public static function get_dal_instance(){
        return Cms_Dal::instance();
    }
}
