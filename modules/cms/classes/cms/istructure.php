<?php defined('SYSPATH') or die('No direct script access.');

interface Cms_iStructure {
    public static function factory($alias);

//    public static function get_all();
//    public static function get_all_table_names();
//    public static function create($table_name, array $columns, array $columns_mapping, array $data, array $default_column_config);
    
    public function get_params();
    public function save_params($data);
}
