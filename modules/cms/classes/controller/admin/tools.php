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
        
        $this->set_content((string)View::factory('cms/tools/structure', array(
            'sections' => array(
                'Нет' => 'Выберите раздел...',
                'content' => 'Контент',
                'catalog' => 'Каталог'
            ),            
        )));
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
                'Нет' => 'Выберите столбец...',
                'id' => 'ID',
                'name' => 'Name'
            ),
            'sections' => array(
                'Нет' => 'Выберите раздел...',
                'content' => 'Контент',
                'catalog' => 'Каталог'
            ),
            'edit_controls' => array(
                'Нет' => 'Нет', 
                'Textbox' => 'Textbox', 
                'Dropdown' => 'Dropdown List', 
                'Other' => 'Other'
            ),
            'edit_controls_editable' => json_encode(array('Textbox', 'Other')),
            'list_controls' => array(
                'Нет' => 'Нет', 
                'Checkbox' => 'Checkbox', 
                'Textbox' => 'Textbox', 
                'Other' => 'Other'
            ),
            'list_controls_editable' => json_encode(array('Textbox', 'Checkbox')),
            'align' => array(
                'Left' => 'Left', 
                'Center' => 'Center', 
                'Right' => 'Right'
            ),
            'colors' => array(
                'Auto' => '',
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
    
    public function action_save() {
        if (HTTP_Request::POST != $this->request->method()){
            throw new HTTP_Exception_404();
        }
        
        $apply = Arr::get($this->request->post(), 'apply', 0);
        $table_name = Arr::get($this->request->post(), 'table_name');
        
        if($apply == 1){
            Request::current()->redirect(Cms_Urlmanager::get_tools_url('table', $table_name));
        }
        
        Request::current()->redirect(Cms_Urlmanager::get_tools_url('structure'));        
    }
}

