<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Ajax extends Controller_Base_Ajax {
    
    public function action_change_column_param(){
        $table = $this->request->post('table');
        $field = $this->request->post('field');
        $value = $this->request->post('value');
        
        $this->result['msg'] = $table . ' ' . $field . ' '. $value;
    }
    
}
