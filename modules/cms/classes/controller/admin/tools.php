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
        
        $diff_data = $this->get_structure_difference();

        foreach ($diff_data['tables'] as $table) {  /* @var $table Cms_Structure */
            $alias = $table->get_alias();
            $tooltip = '';
            if(in_array($alias, $diff_data['to_del'])){
                $tooltip = (string)View::factory('cms/tools/table_list_warning', array(
                    'color' => 'red',
                    'icon' => 'fa-warning',
                    'text' => 'Таблица в БД не найдена!'
                ));
            }
            else if(in_array($alias, $diff_data['to_change'])){
                $tooltip = (string)View::factory('cms/tools/table_list_warning', array(
                    'color' => 'orange',
                    'icon' => 'fa-warning',
                    'text' => 'Изменилась структура таблицы в БД!'
                ));                
            }
            else{
                $tooltip = (string)View::factory('cms/tools/table_list_warning', array(
                    'color' => 'green',
                    'icon' => 'fa-check',
                    'text' => 'Изменений в структуре не найдено!'
                ));                 
            }
            
            $table->set_option('structure-tooltip', $tooltip);
        }
        
        $this->set_content((string)View::factory('cms/tools/structure', array(
            'sections' => array(
                'Нет' => 'Выберите раздел...',
                'content' => 'Контент',
                'catalog' => 'Каталог'
            ),
            'tables' => $diff_data['tables'],
            'tables_to_add' => $diff_data['to_add']
        )));
    }   
    
    public function action_table() {
        $alias = $this->request->param('id');
        if(!$alias) throw new HTTP_Exception_404;
        
        $table = Cms_Structure::factory($alias);
        if(!$table) throw new HTTP_Exception_404;

        $table_name_to_caption = $table->get_alias() == $table->get_table_name()
                ? '«'.$alias.'»'
                : '«'.$alias.'» («'.$table->get_table_name().'»)';
        $this->set_caption('Настройка таблицы <span>'.$table_name_to_caption.'</span>');
        
        $validation_rules = array();
        $columns = array('Нет' => 'Выберите столбец...');
        
        foreach ($table->get_columns() as $column_name => $column) {
            $validation_rules[$column_name] = (string) View::factory('cms/tools/validation', 
                    array('rules' => $column['validation_rules']));
            
            $columns[$column_name] = $column_name;
        }
        
        $this->set_content((string)View::factory('cms/tools/table', array(
            'table' => $table,
            'users' => array(
                Cms::ACCESS_SUPERADMIN => 'СУПЕР АДМИН',
                Cms::ACCESS_ADMIN => 'Администратор',
                Cms::ACCESS_USER => 'Пользователь'
            ),
            'columns' => $columns,

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

    public function action_sync(){
        $diff_data = $this->get_structure_difference();
        
        foreach ($diff_data['to_add'] as $tname){
            $this->create_table($tname);
        }
        
        foreach ($diff_data['to_change'] as $alias){
            $this->sync_table($alias);
        }
                
        Request::current()->redirect(Cms_Urlmanager::get_tools_url('structure'));
    }

//    public function action_test(){
//       
//    }  
    
    private function create_table($table_name){
        $new_table = new Cms_Structure($table_name, TRUE);
        
        $default_params = Cms::get_default_table_params();
        
        $names_matching = Cms::get_names_matching();
        if(array_key_exists($table_name, $names_matching)){
            $default_params['name'] = $names_matching[$table_name];
        }
        else{
            $default_params['name'] = str_replace('_', ' ', Text::ucfirst($new_table->get_alias()));
        }
        
        $default_column_config = Cms::get_default_column();
        $matching_rules = Cms::get_columns_matching_rules();

        $columns_data = Cms::get_dal_instance()->get_columns($new_table->get_table_name());
        
        $special_columns = Cms::get_special_columns();
        foreach ($special_columns as $param_name => $column_names){
            if(array_key_exists($param_name, $default_params)){
                foreach ($column_names as $col_name) {
                    if(array_key_exists($col_name, $columns_data)){
                        $default_params[$param_name] = $col_name;
                    }
                }
            }
        }
        
        $new_table->set_options($default_params)
                ->create_columns($columns_data, $matching_rules, $default_column_config)
                ->save();
        
        return $new_table;
    }
    
    private function sync_table($alias){
        $table = Cms_Structure::factory($alias);
        
        if(!$table){
            throw new Exception('Таблица '.$alias.' не найдена');
        }
        
        $old_columns = $table->get_columns();
        
        $default_column_config = Cms::get_default_column();
        $matching_rules = Cms::get_columns_matching_rules();
        $columns_data = Cms::get_dal_instance()->get_columns($table->get_table_name());       
        $new_columns = $table->create_columns($columns_data, $matching_rules, $default_column_config)->get_columns();
        
        $result_columns = array();
        foreach ($columns_data as $col_name => $col_data) {
            if(array_key_exists($col_name, $old_columns)){
                $result_columns[$col_name] = $old_columns[$col_name];
            }
            else{
                $result_columns[$col_name] = $new_columns[$col_name];
            }
        }
        
        $table->set_columns($result_columns)->save();
    }

    private function get_structure_difference(){
        // Список таблиц
        $tables = Cms_Structure::get_all_tables();
        
        $db_data = array();
        $db_tables = array_diff(Cms::get_dal_instance()->get_tables(), Cms::get_ignore_tables());
        
        foreach ($db_tables as $db_table_name) {
            $db_data[$db_table_name] = Cms::get_dal_instance()->get_columns($db_table_name);
        }
        
        $structure_table_names = Cms_Structure::get_all_table_names(); 

        $to_del = array();
        $to_add = array_diff($db_tables, $structure_table_names);
        $to_change = array();
        
        foreach ($tables as $table) {
            $alias = $table->get_alias();
            $tname = $table->get_table_name();

            // Если таблица есть в БД - сравниваем столбцы
            if(array_key_exists($tname, $db_data)){
                $tcolumns = $table->get_columns();
                $db_columns = $db_data[$tname];

                // Если столбцы в БД и в файле структуры различаются - требуются изменения
                if(array_keys($tcolumns) != array_keys($db_columns)){
                    $to_change[] = $alias;
                }                
            }
            // Если таблицы нет в БД - к удалению
            else{
                $to_del[] = $alias;
            }
        }
        
        $result = array(
            'tables' => $tables,
            'db_data' => $db_data,
            'to_add' => $to_add,
            'to_del' => $to_del,
            'to_change' => $to_change
        );
        
        return $result;
    }
}

