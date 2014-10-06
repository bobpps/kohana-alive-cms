<?php defined('SYSPATH') or die('No direct script access.');

//include_once './cms/fckeditor/fckeditor.php';

define('CMS_FOLDER', 'admin');
define('URL_PREFIX', 'admin');

Route::set('cms_default', URL_PREFIX.'(/<controller>(/<action>(/<id>)))',
                array('directory' => CMS_FOLDER))
	->defaults(array(
                'directory'  => CMS_FOLDER,
		'controller' => 'home',
		'action'     => 'index',
	));



