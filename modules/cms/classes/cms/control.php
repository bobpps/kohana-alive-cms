<?php defined('SYSPATH') or die('No direct script access.');

class Cms_Control {
    
    public static function columneditor($name, $value, array $attributes = NULL)
    {
        return (string)View::factory('cms/helpers/form/editor', array('name' => $name, 'value' => $value, 'attributes' => $attributes));
    }  
    
}