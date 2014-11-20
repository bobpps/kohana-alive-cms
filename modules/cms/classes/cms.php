<?php

class Cms {
    
    const ACCESS_USER = 0;
    const ACCESS_ADMIN = 1;
    const ACCESS_SUPERADMIN = 2;
    
    public static $config = array(
        'table_config' => array(
            'access' => CMS::ACCESS_USER,
            'id_column' => 'id',
            'is_active_column' => NULL,
            'sort_order_column' => NULL,
            'menu_section' => NULL,
            'order' => 100,
            'width' => 0,
            'adding' => TRUE,
            'removing' => TRUE,
            'editing' => TRUE,
            'search' => TRUE,
            'order_by' => '',
            'where' => '', 
            'columns' => array()   
        ),
        'names_mapping' => array(
            'pages' => 'Страницы',
            'news'  => 'Новости',
            'settings' => 'Настройки',
            'gallery' => 'Галерея',
            'catalog' => 'Каталог',
            'catalogue' => 'Каталог',
        ),
        'special_columns' => array(
            'id' => array('id'),
            'is_active' => array('is_active', 'active'),
            'sorting' => array('sort_order', 'sort', 'sortorder', 'sort_no', 'sortno')
        ),
        'default_column' => array(
            'edit' => 'Hidden',
            'edit_sort' => 100,
            'list' => 'Hidden',
            'list_sort' => 100,
            'color' => 'Auto',
            'align' => 'Left',
            'validation_rules' => array()      
        ),
        'columns_mapping' => array(
            array(
                'matching' => array(
                    //'type' => '#^(string|int)$#i',
                    'is_nullable' => 1
                ),
                'through' => TRUE,
                'data' => array('validation_rules' => array('required' => ''))
            ),
            array(
                'matching' => array(
                    'type' => 'string'
                ),
                'through' => TRUE,
                'data' => array('validation_rules' => array('maxlength' => ':character_maximum_length'))
            ),            
            array(
                'matching' => array(
                    'column_name' => 'id'
                ),
                'through' => FALSE,
                'data' => array(
                    'name' => 'ID',
                    'edit' => 'Textbox',
                    'edit_sort' => 1,
                    'list' => 'Hidden',
                    'list_sort' => 10,                    
                )
            ),            
            array(
                'matching' => array(
                    'column_name' => 'name'
                ),
                'through' => FALSE,
                'data' => array(
                    'name' => 'Название',
                    'edit' => 'Textbox',
                    'edit_sort' => 10,
                    'list' => 'String',
                    'list_sort' => 10,                    
                )
            ),
        )
    );    
    
    
    /**
     * @return \Cms_iDal
     */
    public static function get_dal_instance(){
        return Cms_Dal::instance();
    }
    
    /**
     * 
     * @return array
     */
    // Rework it. This method should return collection of Structure classes.
    public static function get_all(){
        Cms_Structure::check_dir_exist();
        
        $files = scandir(DOCROOT . Cms_Structure::STRUCTURE_PATH);
        $tables = array();
        foreach ($files as $file) {
            if(strpos($file, '.'.Cms_Structure::STRUCTURE_FILE_EXT) > 0){
                $file_name = Cms_Structure::create_file_name(str_replace('.'.Cms_Structure::STRUCTURE_FILE_EXT, '', $file));
                
                if(file_exists($file_name)){
                    $content = file_get_contents($file_name);
                    $data = json_decode($content, TRUE);
                    $tables[$data['alias']] = $data;
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
        $tables = self::get_all();
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
     * @param array $columns
     * @param array $columns_mapping
     * @param array $params     
     * @param array $default_column_config
     * @return \Cms_Structure
     */
    public static function create($table_name, array $columns, array $columns_mapping, array $params, array $default_column_config){
        $alias = self::get_correct_alias($table_name); // Used only this
        
        $new_table = new Cms_Structure($alias, TRUE);
        
        $params['alias'] = $alias;
        $params['table_name'] = $table_name;
        if(!Arr::get($params, 'name')){
            $params['name'] = str_replace('_', ' ', Text::ucfirst($table_name));
        }
        
        // TODO: Надо создать столбцы здесь, а логику применения настроек вынести в Структуру
        
        
        // Перебираем столбцы
        foreach ($columns as $column_name => $column_params) {
            $column = $default_column_config;
            $column['name'] = str_replace('_', ' ', Text::ucfirst($column_name));
            
            // Перебираем правила
            foreach ($columns_mapping as $rule) {
                // Если условия совпали - применяем данные
                if(self::check_mapping_rule($column_params, $rule['matching']))  // Used only this
                {
                    // Форматируем данные
                    $rule_data = self::set_value_from_params($column_params, $rule['data']);  // Used only this
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
    
    
    // TODO: Эта логка должна быть в Структуре и вызываться при сохранении файла
    
    /**
     * 
     * @param string $alias
     * @return string
     */
    private static function get_correct_alias($alias){
        $tables = Cms::get_all();
        
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
   
    
    // Эти методы должны переехать в Структуру вслед за логикой сопоставления параметров
    
    /**
     * 
     * @param array $column_params
     * @param array $data
     * @return array
     */
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

    /**
     * 
     * @param array $column_params
     * @param array $matching_rules
     * @return boolean
     */
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
    
    
}
