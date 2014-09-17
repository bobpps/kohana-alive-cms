<?php

defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Base_Ajax extends Controller {

    public $result = array("success" => TRUE);
    public $error = NULL;

    public function before() {
        if (!$this->request->is_ajax()) {
            throw new HTTP_Exception_404;
        }
        
        parent::before();        
    }

    public function after() {
        if (is_string($this->error)) {
            $this->result['errormessage'] = 'Произошла ошибка: «' . $this->error . '»';
            $this->result['success'] = FALSE;
        }

        $this->response->body(json_encode($this->result));
        $this->response->headers('Content-Type', 'application/json');
        $this->response->send_headers();
        //echo json_encode($this->result);
        
        parent::after();
    }

}
