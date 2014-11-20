<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Ajax extends Controller_Base_Ajax {
    
    public function action_change_column_param(){
        try {
            $alias = $this->request->post('alias');
            $column = $this->request->post('column');
            $field = $this->request->post('field');
            $value = $this->request->post('value');

            $table = Cms_Structure::factory($alias);
            if($table == NULL){
                throw new Exception('Не удалось применить изменения. Обратитесь к администратору сайта!');
            }
            
            $table_params = $table->get_params();
            $columns = $table_params['columns'];
            
            $columns[$column][$field] = $value;
            $table->save_params(array('columns' => $columns));
         
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

            $table_params = $table->get_params(); 

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
            
            $table_params['columns'][Arr::get($post, 'column')]['validation_rules'] = $rules;
            $table->save_params($table_params);

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
            $column = $this->request->post('column');

            $table = Cms_Structure::factory($alias);
            if($table == NULL){
                throw new Exception('Не удалось применить изменения. Обратитесь к администратору сайта!');
            }        

            $params = $table->get_params();
            $rules = $params['columns'][$column]['validation_rules'];
            
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
            $data[$field] = $value;
            $table->save_params($data);
         
        } catch (Exception $exc) {
            $this->set_error($exc->getMessage());
        }
    }
    
}
