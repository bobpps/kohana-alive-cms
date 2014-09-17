<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Tools extends Controller_Admin_Base {

    public function before() {
        parent::before();
        
        $this->add_style('cms/css/tools.css');
        $this->add_script('cms/js/tools.js');
    }

    public function action_index() {
        $this->set_caption('Инструменты разработчика');        
        
        $this->template->content = "<p>INDEX</p>";
    }
    
    public function action_structure() {
        $this->set_caption('Структура Базы Данных');
        
        $this->set_content((string)View::factory('cms/tools/structure'));
    }    
    
    public function action_table() {
        $table_name = $this->request->param('id');
        
        if(!$table_name) throw new HTTP_Exception_404;

        $this->set_caption('Настройка таблицы <span>«'.$table_name.'»</span>');
        
        $this->set_content((string)View::factory('cms/tools/table', array(
            'users' => array(
                1 => 'Админ',
                2 => 'Юзер'
            ),
            'columns' => array(
                0 => 'Выберите столбец...',
                'id' => 'ID',
                'name' => 'Name'
            ),
            'sections' => array(
                0 => 'Выберите раздел...',
                'content' => 'Контент',
                'catalog' => 'Каталог'
            ),
            'edit_controls' => array(
                'Нет' => 'Нет', 
                'Textbox' => 'Textbox', 
                'Dropdown' => 'Dropdown List', 
                'Other' => 'Other'
            ),
            'list_controls' => array(
                'Нет' => 'Нет', 
                'Checkbox' => 'Checkbox', 
                'Textbox' => 'Textbox', 
                'Other' => 'Other'
            ),
            'align' => array(
                'Left' => 'Left', 
                'Center' => 'Center', 
                'Right' => 'Right'
            ),
            'colors' => array(
                'Black' => 'Black', 
                'Gray' => 'Gray', 
                'Red' => 'Red', 
                'Maroon' => 'Maroon',
                'Olive' => 'Olive',
                'Green' => 'Green',
                'Teal' => 'Teal',
                'Blue' => 'Blue',
                'Navy' => 'Navy',
                'Purple' => 'Purple'                
            )
        )), 'table_settings');
    } 
}

