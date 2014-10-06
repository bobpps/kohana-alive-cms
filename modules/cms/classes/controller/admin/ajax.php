<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Ajax extends Controller_Base_Ajax {
    
    public function action_change_column_param(){
        $alias = $this->request->post('alias');
        $field = $this->request->post('field');
        $value = $this->request->post('value');
        
        $msg = $alias . ' ' . $field . ' '. $value; 
        
        $this->add_result_data('msg', $msg);
        
        sleep(1);
    }
    
    public function action_change_validation_rules(){
        $html = (string)View::factory('cms/tools/validation');
        
        sleep(1);
        
        $this->add_result_data('html', $html);
    }    
    
    public function action_get_validation_rules_form(){
        $html = (string)View::factory('cms/tools/validation_popup');
        
        sleep(1);
        
        $this->add_result_data('html', $html);
    }
    
    public function action_change_table_param(){
        $alias = $this->request->post('alias');
        $field = $this->request->post('field');
        $value = $this->request->post('value');
        
        $msg = $alias . ' ' . $field . ' '. $value; 
        
        $this->add_result_data('msg', $msg); 
        
        sleep(1);
    }
    
}
