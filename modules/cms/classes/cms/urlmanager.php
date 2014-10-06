<?php

class Cms_Urlmanager{
    
    public static function get_tools_url($action, $id = NULL){
        return Route::url('cms_default', array(
                'directory'  => CMS_FOLDER,
		'controller' => 'tools',            
                'action' => $action,
                'id' => $id
            ));
    }
    
}