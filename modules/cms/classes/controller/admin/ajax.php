<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Ajax extends Controller_Base_Ajax {
    
    public function action_change_column_param(){
        try {
            $alias = $this->request->post('alias');
            $column_name = $this->request->post('column');
            $field = $this->request->post('field');
            $value = $this->request->post('value');

            $table = Cms_Structure::factory($alias);
            if($table == NULL){
                throw new Exception('Не удалось применить изменения. Обратитесь к администратору сайта!');
            }

            $column = $table->get_column($column_name);
            if(!$column) throw new Exception('Column with name "'.$column_name.'" not found.');
            
            $column[$field] = $value;
            
            $table->set_column($column_name, $column)->save();
            
//            $table_params = $table->get_params();
//            $columns = $table_params['columns'];
//            
//            $columns[$column][$field] = $value;
//            $table->save_params(array('columns' => $columns));
         
        } catch (Exception $exc) {
            $this->set_error($exc->getMessage());
        }        
    }
    
    public function action_change_validation_rules(){
//        $alias = $this->request->post('alias');
//        $column = $this->request->post('column');

        try{
            $post = $this->request->post();

            $table = Cms_Structure::factory(Arr::get($post, 'alias'));
            if($table == NULL){
                throw new Exception('Не удалось применить изменения. Обратитесь к администратору сайта!');
            }

            //$table_params = $table->get_params(); 

            $rules = array();
            if(Arr::get($post, 'required')){
                $rules['required'] = '';
            }
            if(Arr::get($post, 'maxlength') && is_numeric(Arr::get($post, 'maxlength_value'))){
                $rules['maxlength'] = Arr::get($post, 'maxlength_value');
            }
            if(Arr::get($post, 'regexp') && is_string(Arr::get($post, 'regexp_value')) && Arr::get($post, 'regexp_value') != ''){
                $rules['regexp'] = Arr::get($post, 'regexp_value');
            }
            if(Arr::get($post, 'max') && is_numeric(Arr::get($post, 'max_value'))){
                $rules['max'] = Arr::get($post, 'max_value');
            }
            if(Arr::get($post, 'min') && is_numeric(Arr::get($post, 'min_value'))){
                $rules['min'] = Arr::get($post, 'min_value');
            }
            
            $column = $table->get_column(Arr::get($post, 'column'));
            if(!$column) throw new Exception('Column with name "'.$column_name.'" not found.');
            
            $column['validation_rules'] = $rules;
            $table->set_column(Arr::get($post, 'column'), $column)->save();
            
//            $table_params['columns'][Arr::get($post, 'column')]['validation_rules'] = $rules;
//            $table->save_params($table_params);

            $html = (string)View::factory('cms/tools/validation', array(
                'rules' => $rules
            ));

            $this->add_result_data('html', $html);
            
        } catch (Exception $exc) {
            $this->set_error($exc->getMessage());
        }            
    }    
    
    public function action_get_validation_rules_form(){
        try{
            $alias = $this->request->post('alias');
            $column_name = $this->request->post('column');

            $table = Cms_Structure::factory($alias);
            if($table == NULL){
                throw new Exception('Не удалось применить изменения. Обратитесь к администратору сайта!');
            }        

            //$params = $table->get_params();
            $column = $table->get_column($column_name);
            $rules = $column['validation_rules']; //$params['columns'][$column_name]['validation_rules'];
            
            $html = (string)View::factory('cms/tools/validation_popup', array('rules' => $rules));

            $this->add_result_data('html', $html);      
            
        } catch (Exception $exc) {
            $this->set_error($exc->getMessage());
        }
    }
    
    public function action_change_table_param(){
        try {
            $alias = $this->request->post('alias');
            $field = $this->request->post('field');
            $value = $this->request->post('value');

            $table = Cms_Structure::factory($alias);
            if($table == NULL){
                throw new Exception('Не удалось применить изменения. Обратитесь к администратору сайта!');
            }
            
            if($field == 'alias'){
                $table->set_alias($value)->save();
                $this->add_result_data('newAlias', $table->get_alias());
            }
            else{
                $table->set_option($field, $value)->save();
            }
        } catch (Exception $exc) {
            $this->set_error($exc->getMessage());
        }
    }
    
    public function action_delete_table(){
        try {
            $tables = $this->request->post('tables');

            if(Arr::is_array($tables)){
                foreach ($tables as $alias){
                    $table = Cms_Structure::factory($alias);
                    if($table != NULL){
                        unlink($table->get_file_name());
                    }
                }
            }
            
            $this->add_result_data('urlToRedirect', Cms_Urlmanager::get_tools_url('structure'));
        } catch (Exception $exc) {
            $this->set_error($exc->getMessage());
        }            
    }

//    private function create_new_data_structure($data){
//        return array(
//            'alias' => Arr::get($data, 'alias'),
//            'table_name' => Arr::get($data, 'table_name'),
//            'options' => array(
//                'name' => Arr::get($data, 'name'),
//                'access' => Arr::get($data, 'access'),
//                'id_column' => Arr::get($data, 'id_column'),
//                'is_active_column' => Arr::get($data, 'is_active_column'),
//                'sort_order_column' => Arr::get($data, 'sort_order_column'),
//                'menu_section' => Arr::get($data, 'menu_section'),
//                'order' => Arr::get($data, 'order'),
//                'width' => Arr::get($data, 'width'),
//                'adding' => Arr::get($data, 'adding'),
//                'removing' => Arr::get($data, 'removing'),
//                'editing' => Arr::get($data, 'editing'),
//                'search' => Arr::get($data, 'search'),
//                'order_by' => Arr::get($data, 'order_by'),
//                'where' => Arr::get($data, 'where'),              
//            ),
//            'columns' => Arr::get($data, 'columns')
//        );
//    }
    
}
