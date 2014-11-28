<?php defined('SYSPATH') or die('No direct script access.');

interface Cms_iStructure {
    public function __construct($alias, $is_new = FALSE);
    
    public static function factory($alias);
    public static function get_all_tables();
    public static function get_all_table_names();
    
    public function get_alias();
    public function set_alias($alias);
    
    public function get_table_name();
    
    public function get_options();
    public function set_options(array $options);
    
    public function get_option($option_name);
    public function set_option($option_name, $value, $check_exist = FALSE);
    
    public function get_columns();
    public function set_columns($columns);
    
    public function get_column($column_name);
    public function set_column($column_name, array $value, $check_exist = FALSE);
    
    public function save();
    public function create_columns(array $columns_data, array $matching_rules, array $default_options);
}
