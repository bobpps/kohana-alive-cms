<?php

class Cms {
    
    const ACCESS_USER = 0;
    const ACCESS_ADMIN = 1;
    const ACCESS_SUPERADMIN = 2;
    
    public static $config = array(
        'default_table_params' => array(
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
            //'columns' => array()   
        ),
        'default_column' => array(
            'edit' => NULL,
            'edit_sort' => 100,
            'list' => NULL,
            'list_sort' => 100,
            'color' => 'Auto',
            'align' => 'Left',
            'validation_rules' => array()      
        ),        
        'special_columns' => array(
//            'id_column' => array('id'),
//            'is_active_column' => array('is_active', 'active'),
//            'sort_order_column' => array('sort_order', 'sort', 'sortorder', 'sort_no', 'sortno', 'order')
        ),
        'ignore_tables' => array(
            //'news'
        ),
        'names_matching' => array(
//            'pages' => 'Страницы',
//            'news'  => 'Новости',
//            'settings' => 'Настройки',
//            'gallery' => 'Галерея',
//            'catalog' => 'Каталог',
//            'catalogue' => 'Каталог',
        ),
        'columns_matching_rules' => array(
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
    
    /**
     * 
     * @return array
     */
    public static function get_default_table_params(){
        $config_section = 'default_table_params';
        return self::get_config($config_section);
    }
    
    /**
     * 
     * @return array
     */    
    public static function get_default_column(){
        $config_section = 'default_column';
        return self::get_config($config_section);
    }
    
    /**
     * 
     * @return array
     */    
    public static function get_special_columns(){
        $config_section = 'special_columns';
        return self::get_config($config_section);
    }
    
    /**
     * 
     * @return array
     */    
    public static function get_ignore_tables(){
        $config_section = 'ignore_tables';
        return self::get_config($config_section);
    }
    
    /**
     * 
     * @return array
     */    
    public static function get_names_matching(){
        $config_section = 'names_matching';
        return self::get_config($config_section);
    }
    
    /**
     * 
     * @return array
     */    
    public static function get_columns_matching_rules(){
        $config_section = 'columns_matching_rules';
        return self::get_config($config_section);
    }    

    /**
     * 
     * @return array
     */
    private static function get_config($config_section, $group = 'default'){
        $config_file = Kohana::$config->load('cms')->get($group);
        $self_config = self::$config;
        
        $config = $config_file + $self_config;
        
        if(isset($config[$config_section])) {
            return $config[$config_section];
        }
        else{
            return array();
        }        
    }
    
}
