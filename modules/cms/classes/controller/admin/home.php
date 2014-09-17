<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Home extends Controller_Admin_Base {

    public function before() {
        parent::before();

    }

    public function action_index() {
        $this->template->content = "<p>!!!!!!!!!</p>";
    }

//    public function action_error() {
//        $code = (int) $this->request->param('code');
//        if (Request::$initial == Request::$current) {
//            $code = 404;
//        }
//
//        if ($code == 404) {
//            $message = 'Страница не найдена...';
//            $text = '<p>Вероятно страница была перемещена или устарела.</p><p>Приносим извинения за причиненные неудобства.</p>';
//        } else if ($code == 403) {
//            $message = 'Доступ запрещен!';
//            $text = '<p>У Вас недостаточно прав для просмотра данной страницы.</p>';
//        } else {
//            $message = 'Ошибка сервера.';
//            $text = '<p>Попробуйте через несколько минут обновить страницу. 
//                        Если это не поможет, свяжитесь с администратором сайта и опишите Ваши действия, после которых появляется эта ошибка.</p>
//                        <p>Приносим извинения за причиненные неудобства.</p>';
//        }
//
//        $this->template->caption = $message;
//        $this->template->breadcrumb->name = $message;
//        $this->template->content = $text;
//
//        $this->response->status($code);
//    }

}

// End Welcome
