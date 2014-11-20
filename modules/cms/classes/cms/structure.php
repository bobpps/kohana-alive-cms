<?php defined('SYSPATH') or die('No direct script access.');

class Cms_Structure implements Cms_iStructure {

    private $_alias; 
    private $_params;
        
    /**
     * 
     * @param string $alias
     */
    function __construct($alias, $is_new = false) {
        // Check that the directory is exist and create one if it needs.
        Cms_Structure::check_dir_exist();
        
        $this->_alias = $alias;
        
        if(!$is_new){
            $this->_params = $this->load_params_from_file();
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
     * @return array
     */
    public static function get_all(){
        Cms_Structure::check_dir_exist();
        
        $files = scandir(DOCROOT . Cms::STRUCTURE_PATH);
        $tables = array();
        foreach ($files as $file) {
            if(strpos($file, '.'.Cms::STRUCTURE_FILE_EXT) > 0){
                $file_name = Cms_Structure::create_file_name(str_replace('.'.Cms::STRUCTURE_FILE_EXT, '', $file));
                
                if(file_exists($file_name)){
                    $content = file_get_contents($file_name);
                    $data = json_decode($content, TRUE);
                    $tables[$data['alias']] = $data;
                }                
            }
        }
        
        return $tables;
    }
    
    public static function get_all_table_names(){
        $tables = Cms_Structure::get_all();
        $table_names = array();
        
        foreach ($tables as $alias => $data){
            if(Arr::get($table_names, $data['table_name']) == NULL){
                $table_names[] = $data['table_name'];
            }
        }
        
        return $table_names;
    }    
    
    /**
     * 
     * @param string $table_name
     * @param array $ident_rules
     * @param array $columns
     * @return \Cms_Structure
     */
    public static function create($table_name, array $columns, array $columns_mapping, array $params, array $default_column_config){
        $alias = Cms_Structure::get_correct_alias($table_name);
        
        $new_table = new Cms_Structure($alias, TRUE);
        
        $params['alias'] = $alias;
        $params['table_name'] = $table_name;
        if(!Arr::get($params, 'name')){
            $params['name'] = str_replace('_', ' ', Text::ucfirst($table_name));
        }
        
        // Перебираем столбцы
        foreach ($columns as $column_name => $column_params) {
            $column = $default_column_config;
            $column['name'] = str_replace('_', ' ', Text::ucfirst($column_name));
            
            // Перебираем правила
            foreach ($columns_mapping as $rule) {
                // Если условия совпали - применяем данные
                if(self::check_mapping_rule($column_params, $rule['matching']))
                {
                    // Форматируем данные
                    $rule_data = self::set_value_from_params($column_params, $rule['data']);
                    $column = Arr::merge($column, $rule_data);
                    
                    // Если правило не сквозное - прекращаем перебор правил
                    if(!$rule['through']) break;
                }
            }
            
            // Добавляем столбец в параметры таблицы
            $params['columns'][$column_name] = $column;
        }
        
        $new_table->save_params($params);
        return $new_table;
    }
    
    /**
     * 
     * @return array
     */
    public function get_params(){
        return $this->_params;
    }
    
    /**
     * 
     * @param array $params
     */
    public function save_params($params){
        if(Arr::is_array($this->_params)){
            $this->_params = $params + $this->_params;
        }
        else{
            $this->_params = $params;
        }
        
        $this->save_params_to_file();
    }
    
    public function show_params(){
        if(Kohana::$environment != Kohana::DEVELOPMENT){
            return;
        }
        
        echo '<pre>';
        print_r($this->_params);
        echo '</pre>';
    }

//    public function change_table_params(array $params){
//        $result = array();
//        $result['alias'] = $params['alias'];
//        $result['access'] = $params['access'];        
//        $result['name'] = $params['name'];
//        $result['id_column'] = $params['id_column'];
//        $result['is_active_column'] = $params['is_active_column'];
//        $result['sort_order_column'] = $params['sort_order_column'];
//        $result['menu_section'] = $params['menu_section'];
//        $result['order'] = $params['order'];
//        $result['width'] = $params['width'];
//        $result['adding'] = $params['adding'];
//        $result['removing'] = $params['removing'];
//        $result['editing'] = $params['editing'];
//        $result['search'] = $params['search'];
//        $result['order_by'] = $params['order_by'];
//        $result['where'] = $params['where'];
//        
//        $this->change_data($result);
//    }
//    
//    public function change_table_param($param, $value){
//        $data = array();
//        $data[$param] = $value;
//        $this->change_data($data);
//    }
//    
//    public function change_column_param($column_name, $param, $value){
//        $this->_data['columns'][$column_name][$param] = $value;
//        $this->save_data();
//    }
    
    private static function set_value_from_params(array $column_params, array $data){
        
        foreach ($data as $data_key => $value) {
            if(Arr::is_array($value))
            {
                $data[$data_key] = self::set_value_from_params($column_params, $value);
            }
            else if(is_string($value)){
                if(UTF8::substr($value, 0, 1) == ':'){
                    $key = str_replace(':', '', $value);
                    if(Arr::get($column_params, $key)){
                        $data[$data_key] = $column_params[$key];
                    }
                }                
            }
        }
       
        return $data;
    }


    private static function check_mapping_rule(array $column_params, array $matching_rules){
        foreach ($matching_rules as $key => $value) {
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


    private static function check_dir_exist(){
        $path = DOCROOT . Cms::STRUCTURE_PATH;
        
        if(!file_exists($path) || !is_dir($path)){
            mkdir($path, 0777, TRUE);
        }        
    }
    
    private static function create_file_name($alias){
        
        return DOCROOT.Cms::STRUCTURE_PATH.DIRECTORY_SEPARATOR
                .$alias.'.'.Cms::STRUCTURE_FILE_EXT;
    }
    
    private static function get_correct_alias($alias){
        $tables = Cms_Structure::get_all();
        
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




//    private function change_data(array $data){
//        $this->_data = $data + $this->_data;
//        $this->save_data();
//    }

    private function load_params_from_file(){
        $file_name = Cms_Structure::create_file_name($this->_alias);
        
        if(file_exists($file_name)){
 
            $content = file_get_contents($file_name);
            return json_decode($content, TRUE);
        }
        
        throw new Exception('File not found');


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
    
    private function save_params_to_file(){
        // Remove old file
        $old_file_name = Cms_Structure::create_file_name($this->_alias);
        if(file_exists($old_file_name)){
            unlink($old_file_name);
        }
        
        // Save data to file
        $new_file_name = Cms_Structure::create_file_name($this->_params['alias']);
        $file = fopen($new_file_name, "w") or die("Unable to open file!");
        $content = json_encode($this->_params);
        fwrite($file, $content);
        fclose($file);        
        
        $this->_alias = $this->_params['alias'];
    }
}
