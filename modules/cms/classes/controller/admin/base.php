<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Base extends Controller_Template {

    public $template = 'cms/layouts/base';

    public function before() {
//                if(!CMS_User::instance()->is_authenticated()){
//                        $this->request->redirect(CMS_Infrastructure_Routes_Manager::login());
//                }

        parent::before();

        $this->template->cms_url_prefix = URL_PREFIX;
        
        $this->template->topmenu = View::factory('cms/navigation/top');
        $this->template->leftmenu = View::factory('cms/navigation/left');

        $this->set_caption('Модуль управления сайтом');

        $this->set_content('', 'main_content');
        
        $this->template->styles = array();
        $this->add_style('cms/css/bootstrap.min.css');
        $this->add_style('cms/font-awesome/css/font-awesome.css');
        $this->add_style('cms/css/sb-admin-2.css');
        $this->add_style('cms/css/style.css');        
        
        $this->template->scripts = array();
        $this->add_script('cms/js/jquery-1.10.2.js');
        $this->add_script('cms/js/bootstrap.min.js');
        $this->add_script('cms/js/plugins/metisMenu/jquery.metisMenu.js');
        $this->add_script('cms/js/plugins/cms/jquery.inputeditor.js');  
        $this->add_script('cms/js/plugins/cms/jquery.controlselect.js');
        $this->add_script('cms/js/plugins/cms/jquery.colorselect.js');
        $this->add_script('cms/js/sb-admin.js');
        $this->add_script('cms/js/script.js');
    }

    protected function set_caption($new_caption, $change_title = true) {
        $this->template->caption = $new_caption;

        if ($change_title) {
            $this->template->title = strip_tags($new_caption);
        }
    }

    protected function set_content($content_text, $content_class = NULL) {
        $this->template->content = $content_text;

        if ($content_class) {
            $this->template->content_class = $content_class;
        }
    }
    
    protected function add_style($file){
        $this->template->styles[] = HTML::style($file);
    }
    
    protected function add_script($file){
        $this->template->scripts[] = HTML::script($file);
    }    

}

// End Base 
