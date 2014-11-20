<?php

class Cms_Dal implements Cms_iDal {

    // Cms_Dal instances
    protected static $_instance;    
    
    public static function instance()
    {
        if ( ! isset(Cms_Dal::$_instance))
        {
            // Create a new Cms_Dal instance
            Cms_Dal::$_instance = new Cms_Dal();
        }

        return Cms_Dal::$_instance;
    }  
    
    protected function __construct() { }   
    private function __clone() { }
    
    
    public function get_tables() {
        return Database::instance()->list_tables();        
    }    
    
    public function get_columns($table_name) {
        return Database::instance()->list_columns($table_name);
    }    
    
    public function add_record($table_name, $data) {
        //throw new 
    }

    public function remove_record($table_name, $id) {
        
    }

    public function update_record($table_name, $id, $data) {
        
    }

//put your code here
}
