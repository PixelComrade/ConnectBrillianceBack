<?php

App::uses('Controller', 'Controller');

class CharitiesController extends Controller {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->autoRender = false;

        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');

        Router::parseExtensions('json');
    }

    public function fetch() {

        $data = $this->Charity->find('all');
        return json_encode($data);
    }
}
