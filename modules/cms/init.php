<?php defined('SYSPATH') or die('No direct script access.');

//include_once './cms/fckeditor/fckeditor.php';

define('CMS_FOLDER', 'admin');
define('URL_PREFIX', 'admin');

//TODO: Вынести роуты в отдельный файл

//Route::set('cms_general', URL_PREFIX.'/<action>_<table>(/<id>)', 
//                array(
//                    'directory' => CMS_FOLDER,
//                    'table'     => '[a-zA-Z0-9_-]+',
//                    'action'    => 'show|edit|add|del',
//                    'id'        => '[0-9]+',
//                )
//        ) 
//	->defaults(array(
//                'directory'  => CMS_FOLDER,
//                'controller' => 'general',
//                'action'     => 'index',
//	));

//Route::set('cms_error', URL_PREFIX.'/error/<code>(/<message>)', array('code' => '[0-9]++', 'message' => '.+'))
//        ->defaults(array(
//            'directory'  => CMS_FOLDER,
//            'controller' => 'welcome',
//            'action' => 'error'
//));
//
//Route::set('cms_tools', URL_PREFIX.'/tools/<action>(/<table>(/<column>(/<id>)))',
//                array(
//                    'directory'  => CMS_FOLDER,
//                    'controller' => 'tools'
//                )
//        )
//	->defaults(array(
//                'directory'  => CMS_FOLDER,
//		'controller' => 'tools',
//		'action'     => 'structure',
//	));
//
//Route::set('cms_logout', URL_PREFIX.'/logout',
//                array('directory' => CMS_FOLDER))
//	->defaults(array(
//                'directory'  => CMS_FOLDER,
//		'controller' => 'login',
//		'action'     => 'logout',
//	));

Route::set('cms_default', URL_PREFIX.'(/<controller>(/<action>(/<id>)))',
                array('directory' => CMS_FOLDER))
	->defaults(array(
                'directory'  => CMS_FOLDER,
		'controller' => 'home',
		'action'     => 'index',
	));



