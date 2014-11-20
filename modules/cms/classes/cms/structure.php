<?php defined('SYSPATH') or die('No direct script access.');

class Cms_Structure implements Cms_iStructure {

    const STRUCTURE_PATH = 'cms/structure';
    const STRUCTURE_FILE_EXT = 'table';    
    
    private $_alias; 
    private $_params;
        
    /**
     * 
     * @param string $alias
     */
    function __construct($alias, $is_new = false) {
        // Check that the directory is exist and create one if it needs.
        self::check_dir_exist();
        
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
    



    public static function check_dir_exist(){
        $path = DOCROOT . self::STRUCTURE_PATH;
        
        if(!file_exists($path) || !is_dir($path)){
            mkdir($path, 0777, TRUE);
        }        
    }
    
    public static function create_file_name($alias){
        
        return DOCROOT.self::STRUCTURE_PATH.DIRECTORY_SEPARATOR
                .$alias.'.'.self::STRUCTURE_FILE_EXT;
    }
    



    private function load_params_from_file(){
        $file_name = self::create_file_name($this->_alias);
        
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
        $old_file_name = self::create_file_name($this->_alias);
        if(file_exists($old_file_name)){
            unlink($old_file_name);
        }
        
        // Save data to file
        $new_file_name = self::create_file_name($this->_params['alias']);
        $file = fopen($new_file_name, "w") or die("Unable to open file!");
        $content = json_encode($this->_params);
        fwrite($file, $content);
        fclose($file);        
        
        $this->_alias = $this->_params['alias'];
    }
}
