<?php

interface Cms_iDal {
    
    /**
    * Singleton pattern
    *
    * @return Cms_iDal
    */
    public static function instance();
    
    
    
    /**
     * Get list of tables
     *
     * @return array
     */
    public function get_tables();
    
    /**
     * Get all columns from table
     *
     * @param   string   $table_name        
     * @return  array
     */
    public function get_columns($table_name);
    
    /**
     * Add new record to table of DB
     * 
     * @param   string   $table_name 
     * @param   array    $data       
     * @return  int                         new record ID
     */
    public function add_record($table_name, $data);
    
    /**
     * Update record
     * 
     * @param   string   $table_name 
     * @param   int      $id                record ID            
     * @param   array    $data       
     * @return  bool
     */    
    public function update_record($table_name, $id, $data);    
    
    /**
     * Remove record
     * 
     * @param   string   $table_name 
     * @param   int      $id                record ID            
     * @return  bool
     */     
    public function remove_record($table_name, $id);
    
}
