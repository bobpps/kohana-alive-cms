<?php defined('SYSPATH') or die('No direct script access.');

class Cms_Structure implements Cms_iStructure {

    const STRUCTURE_PATH = 'cms/structure';
    const STRUCTURE_FILE_EXT = 'table';    
    
    private $_alias; 
    private $_table_name;
    private $_options;
    private $_columns;
    
    private $_file_name;
            
    /**
     * 
     * @param string $alias
     */
    public function __construct($alias, $is_new = FALSE) {
        // Check that the directory is exist and create one if it needs.
        self::check_dir_exist();
        
        $this->_alias = $alias;
        
        if(!$is_new){
            $this->load_data_from_file();
        }
        else{
            $this->_table_name = $alias;
            $this->_alias = $this->get_correct_alias($alias);
        }
    }
    
    /**
     * 
     * @param string $alias
     * @return \Cms_Structure|null
     */
    public static function factory($alias){
        try {
            return new Cms_Structure($alias);
        } catch (Exception $exc) {
            return NULL;
        }
    }   
    
    /**
     * 
     * @return Cms_Structure[]
     */
    public static function get_all_tables(){
        self::check_dir_exist();
        
        $files = scandir(DOCROOT . self::STRUCTURE_PATH);
        $tables = array();        
        
        foreach ($files as $file) {
            if(strpos($file, '.'.self::STRUCTURE_FILE_EXT) > 0){
                $alias = str_replace('.'.self::STRUCTURE_FILE_EXT, '', $file);
                $table = self::factory($alias);
                if($table){
                    $tables[$table->get_alias()] = $table;
                }
            }
        }
        
        return $tables;
    }
    
    /**
     * 
     * @return array
     */    
    public static function get_all_table_names(){
        $tables = self::get_all_tables();
        $table_names = array();
        
        foreach ($tables as $alias => $table){
            if(Arr::get($table_names, $table->get_table_name()) == NULL){
                $table_names[] = $table->get_table_name();
            }
        }
        
        return $table_names;
    } 
    
    /**
     * 
     * @return string
     */
    public function get_alias(){
        return $this->_alias;
    }
    
    /**
     * 
     * @param string $alias
     * @return \Cms_Structure
     */
    public function set_alias($alias){
        $this->_alias = $this->get_correct_alias($alias);
        
        return $this;
    }    
    
    /**
     * 
     * @return string
     */
    public function get_table_name(){
        return $this->_table_name;
    }
    
    
    /**
     * 
     * @return string
     */    
    public function get_file_name(){
        return $this->_file_name;
    }
    
    /**
     * 
     * @return array
     */
    public function get_options(){
        return $this->_options;
    }

    
    /**
     * 
     * @param array $options
     * @return \Cms_Structure
     */
    public function set_options(array $options){
        $this->_options = $options;
        return $this;
    }    
    
    /**
     * 
     * @param string $option_name
     * @return mixed
     */
    public function get_option($option_name){
        return Arr::get($this->_options, $option_name) ;
    }

    /**
     * 
     * @param string $option_name
     * @param mixed $value
     * @return \Cms_Structure
     */
    public function set_option($option_name, $value, $check_exist = FALSE){
        if($check_exist && !array_key_exists($option_name, $this->_options)){
            return $this;
        }
        
        $this->_options[$option_name] = $value;
        return $this;
    }   
    
    /**
     * 
     * @return array
     */
    public function get_columns(){
        return $this->_columns;
    }

    /**
     * 
     * @param array $columns
     * @return \Cms_Structure
     */
    public function set_columns($columns){
        $this->_columns = $columns;
        return $this;
    }    
    
    /**
     * 
     * @param string $column_name
     * @return array
     */
    public function get_column($column_name){
        return Arr::get($this->_columns, $column_name) ;
    }

    /**
     * 
     * @param string $column_name
     * @param array $value
     * @return \Cms_Structure
     */
    public function set_column($column_name, array $value, $check_exist = FALSE){
        if($check_exist && !array_key_exists($column_name, $this->_columns)){
            return $this;
        }        
        
        $this->_columns[$column_name] = $value;
        return $this;
    }      

    /**
     * 
     * @return \Cms_Structure
     */
    public function save(){
        $data = array(
            'alias' => $this->_alias,
            'table_name' => $this->_table_name,
            'options' => $this->_options,
            'columns' => $this->_columns
        );
        
        if(file_exists($this->_file_name)){
            unlink($this->_file_name);
        }
        
        $this->create_file_name();
        
        // Save data to file
        $file = fopen($this->_file_name, "w") or die("Unable to open file!");
        $content = json_encode($data);
        fwrite($file, $content);
        fclose($file); 
        
        return $this;
    }
    
    /**
     * 
     * @param array $columns_data
     * @param array $matching_rules
     * @param array $default_options
     * @return \Cms_Structure
     */
    public function create_columns(array $columns_data, array $matching_rules, array $default_options){
        
        // Перебираем столбцы
        foreach ($columns_data as $column_name => $column_params) {
            $column = $default_options;
            $column['name'] = str_replace('_', ' ', Text::ucfirst($column_name));
            
            // Перебираем правила
            foreach ($matching_rules as $rule) {
                // Если условия совпали
                if($this->check_column_matching_rules($column_params, $rule['matching'])){
                    // Форматируем данные
                    $rule_data = $this->set_column_options_using_matching_rules($column_params, $rule['data']);  // Used only this
                    $column = Arr::merge($column, $rule_data);
                    
                    // Если правило не сквозное - прекращаем перебор правил
                    if(!$rule['through']) break;                    
                }
            }
            
            $this->_columns[$column_name] = $column;
        }
        
        return $this;
    }
    
    /**
     * 
     * @param array $column_params
     * @param array $rule_data
     * @return array
     */
    private function set_column_options_using_matching_rules(array $column_params, array $rule_data){
        foreach ($rule_data as $data_key => $value) {
            if(Arr::is_array($value))
            {
                $rule_data[$data_key] = $this->set_column_options_using_matching_rules($column_params, $value);
            }
            else if(is_string($value)){
                if(UTF8::substr($value, 0, 1) == ':'){
                    $key = str_replace(':', '', $value);
                    if(Arr::get($column_params, $key)){
                        $rule_data[$data_key] = $column_params[$key];
                    }
                }                
            }
        }
       
        return $rule_data;        
    }
    
    /**
     * 
     * @param array $column_params
     * @param array $matching_params
     * @return boolean
     */
    private function check_column_matching_rules(array $column_params, array $matching_params){
        foreach ($matching_params as $key => $value) {
            if(array_key_exists($key, $column_params)){
                // Регулярка
                if(UTF8::substr($value, 0, 1) == '#'){
                    if(!(bool) preg_match($value, $column_params[$key])) return FALSE;
                }
                // Просто сравниваем значения
                else{
                    if($column_params[$key] != $value) return FALSE;
                }
            }
            else{
                return FALSE;
            }
        }
        
        return TRUE;        
    }


//    public function show_params(){
//        if(Kohana::$environment != Kohana::DEVELOPMENT){
//            return;
//        }
//        
//        echo '<pre>';
//        var_dump($this);
//        echo '</pre>';
//    }

    /**
     * 
     */
    private static function check_dir_exist(){
        $path = DOCROOT . self::STRUCTURE_PATH;
        
        if(!file_exists($path) || !is_dir($path)){
            mkdir($path, 0777, TRUE);
        }        
    }
    
    /**
     * 
     */
    private function create_file_name(){
        
        $this->_file_name = DOCROOT.self::STRUCTURE_PATH.DIRECTORY_SEPARATOR
                .  $this->_alias.'.'.self::STRUCTURE_FILE_EXT;
    }
    
    /**
     * 
     * @throws Exception
     */
    private function load_data_from_file(){
        $this->create_file_name();
        
        if(file_exists($this->_file_name)){
 
            $content = file_get_contents($this->_file_name);
            $data = json_decode($content, TRUE);
            
            $this->_alias = Arr::get($data, 'alias');
            if(!$this->_alias) throw new Exception('Incorrect file of structure. Alias not found.');
            
            $this->_table_name = Arr::get($data, 'table_name');
            if(!$this->_alias) throw new Exception('Incorrect file of structure. Table name not found.');
            
            $this->_options = Arr::get($data, 'options', array());
            $this->_columns = Arr::get($data, 'columns', array());
        }
        else{
            throw new Exception('File not found');
        }
        
//        return //array();
//            array(
//                'table_name' => 'test_table',
//                'alias' => 'test_table',
//                'name' => 'Тестовая таблица',
//                'access' => 1,
//                'id_column' => 'id',
//                'is_active_column' => 'is_active',
//                'sort_order_column' => NULL,
//                'menu_section' => 'content',
//                'order' => 100,
//                'width' => 0,
//                'adding' => TRUE,
//                'removing' => FALSE,
//                'editing' => TRUE,
//                'search' => TRUE,
//                'order_by' => '',
//                'where' => '', 
//                'columns' => array(
//                    'id' => array(
//                        'name' => 'ID',
//                        'edit' => 'Hidden',
//                        'edit_sort' => 100,
//                        'list' => 'Hidden',
//                        'list_sort' => 100,
//                        'color' => 'Auto',
//                        'align' => 'Left',
//                        'validation_rules' => array(
//                            'required' => ''
//                        ),
//                    ),
//                    'name' => array(
//                        'name' => 'Название',
//                        'edit' => 'Textbox',
//                        'edit_sort' => 100,
//                        'list' => 'String',
//                        'list_sort' => 100,
//                        'color' => 'Red',
//                        'align' => 'Left',
//                        'validation_rules' => array(
//                            'required' => '',
//                            'maxlength' => 255
//                        ),
//                    ),                
//                ),  
//            );
    }
    
    /**
     * 
     * @param string $alias
     * @return string
     */
    private function get_correct_alias($alias){
        $tables = self::get_all_tables();
        
        if(!array_key_exists($alias, $tables)) {
            return $alias;
        }
        
        $c = 1;
        do {
            $new_alias = $alias.$c;
            $c++;
        } while (array_key_exists($new_alias, $tables));
        
        return $new_alias;
    }     

}
