<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Tools extends Controller_Admin_Base {

    public function before() {
        parent::before();
        
        $this->add_style('cms/css/tools.css');
        $this->add_script('cms/js/tools.js');
    }

    public function action_index() {
        $this->set_caption('Инструменты разработчика');        
        
        $this->template->content = "<p>INDEX</p>";
    }
    
    public function action_structure() {
        $this->set_caption('Структура Базы Данных');
        
        $tables = Cms_Structure::get_all();
                
        $this->set_content((string)View::factory('cms/tools/structure', array(
            'sections' => array(
                'Нет' => 'Выберите раздел...',
                'content' => 'Контент',
                'catalog' => 'Каталог'
            ),
            'tables' => $tables
        )));
    }   
    
    public function action_table() {
        $alias = $this->request->param('id');
        if(!$alias) throw new HTTP_Exception_404;
        
        $table = Cms_Structure::factory($alias);
        if(!$table) throw new HTTP_Exception_404;
        $table_params = $table->get_params();

        $table_name_to_caption = $table_params['alias'] == $table_params['table_name']
                ? '«'.$alias.'»'
                : '«'.$alias.'» («'.$table_params['table_name'].'»)';
        $this->set_caption('Настройка таблицы <span>'.$table_name_to_caption.'</span>');
        
        $validation_rules = array();
        
        foreach ($table_params['columns'] as $column_name => $column) {
            $validation_rules[$column_name] = (string) View::factory('cms/tools/validation', 
                    array('rules' => $column['validation_rules']));
        }
        
        $this->set_content((string)View::factory('cms/tools/table', array(
            'table' => $table_params,
            'users' => array(
                1 => 'Админ',
                2 => 'Юзер'
            ),
            'columns' => array(
                'Нет' => 'Выберите столбец...',
                'id' => 'ID',
                'name' => 'Name'
            ),
            'validation_rules' => $validation_rules,
            'sections' => array(
                'Нет' => 'Выберите раздел...',
                'content' => 'Контент',
                'catalog' => 'Каталог'
            ),
            'edit_controls' => array(
                'Нет' => 'Нет', 
                'Textbox' => 'Textbox', 
                'Dropdown' => 'Dropdown List', 
                'Other' => 'Other'
            ),
            'edit_controls_editable' => json_encode(array('Textbox', 'Other')),
            'list_controls' => array(
                'Нет' => 'Нет', 
                'Checkbox' => 'Checkbox', 
                'Textbox' => 'Textbox', 
                'Other' => 'Other'
            ),
            'list_controls_editable' => json_encode(array('Textbox', 'Checkbox')),
            'align' => array(
                'Left' => 'Left', 
                'Center' => 'Center', 
                'Right' => 'Right'
            ),
            'colors' => array(
                'Auto' => '',
                'Black' => 'Black', 
                'Gray' => 'Gray', 
                'Red' => 'Red', 
                'Maroon' => 'Maroon',
                'Olive' => 'Olive',
                'Green' => 'Green',
                'Teal' => 'Teal',
                'Blue' => 'Blue',
                'Navy' => 'Navy',
                'Purple' => 'Purple'                
            )
        )), 'table_settings');
    } 
    
    public function action_save() {
        if (HTTP_Request::POST != $this->request->method()){
            throw new HTTP_Exception_404();
        }
        
        $post = $this->request->post();
        $apply = Arr::get($post, 'apply', 0);
        
        $alias = Arr::get($post, 'current_alias');
        $table = Cms_Structure::factory($alias);
        
        if(!$table) {
            throw new Exception('Таблица "'.$alias.'" не найдена');
        }
        
        $result = array();
        $result['alias'] = Arr::get($post, 'alias');
        $result['access'] = Arr::get($post, 'access');       
        $result['name'] = Arr::get($post, 'name');
        $result['id_column'] = Arr::get($post, 'id_column');
        $result['is_active_column'] = Arr::get($post, 'is_active_column');
        $result['sort_order_column'] = Arr::get($post, 'sort_order_column');
        $result['menu_section'] = Arr::get($post, 'menu_section');
        $result['order'] = Arr::get($post, 'order');
        $result['width'] = Arr::get($post, 'width');
        $result['adding'] = (bool)Arr::get($post, 'adding', FALSE);
        $result['removing'] = (bool)Arr::get($post, 'removing', FALSE);
        $result['editing'] = (bool)Arr::get($post, 'editing', FALSE);
        $result['search'] = (bool)Arr::get($post, 'search', FALSE);
        $result['order_by'] = Arr::get($post, 'order_by');
        $result['where'] = Arr::get($post, 'where'); 

        $table->save_params($result);
        
        if($apply == 1){
            Request::current()->redirect(Cms_Urlmanager::get_tools_url('table', Arr::get($post, 'alias')));
        }
        
        Request::current()->redirect(Cms_Urlmanager::get_tools_url('structure'));        
    }
    
    public function action_test(){
//        $tables = Database::instance()->list_tables();
//        
//        $columns = Database::instance()->list_columns('pages');
//        
//        $table_names = Cms_Structure::get_all_table_names();
//        
//        echo '<pre>';
//        print_r($table_names);
//        print_r($tables);
//        print_r($columns);
//        echo '</pre>';    
        

//        $arr1 = array(
//            'edit' => 'Hidden',
//            'edit_sort' => 100,
//            'list' => 'Hidden',
//            'list_sort' => 100,
//            'color' => 'Auto',
//            'align' => 'Left',
//            'validation_rules' => array()      
//        );
//        
//        $arr2 = array(
//            'name' => 'Super Name',
//            'edit_sort' => 10,
//            'validation_rules' => array(
//                'required' => '',
//                'maxlength' => 255                
//            )      
//        );        
//        
//        echo '<pre>';
//        print_r(Arr::merge($arr1, $arr2));
//        echo '</pre>';        
        
        
        $config = Cms::$config;
        
        $columns = Cms_Dal::instance()->get_columns('cat_product');
        $new_t = Cms_Structure::create('pages', $columns, $config['columns_mapping'], $config['table_config'], $config['default_column']);
        
        echo '<pre>';
        print_r($new_t);
        echo '</pre>';          
    }    
}

