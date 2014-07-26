<?php

App::uses('Controller', 'Controller');

class UsersController extends Controller {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->autoRender = false;
        Router::parseExtensions('json');

        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Methods', '*');
        $this->response->header('Access-Control-Allow-Headers', 'X-Requested-With');
        $this->response->header('Access-Control-Allow-Headers', 'Content-Type, x-xsrf-token');
        $this->response->header('Access-Control-Max-Age', '172800');

        $this->data = $this->request->input('json_decode');

        if(!isset($this->data) || empty($this->data) || $this->data == "") {

            return json_encode(array('error' => 'No data found'));
        }
    }

    public function login() {

        if(!isset($this->data->AccountName) || $this->data->AccountName == '') {

            return json_encode(array('error' => 'No account name found'));
        }

        if(!isset($this->data->Password) || $this->data->Password == '') {

            return json_encode(array('error' => 'No password found'));
        }

        $user = $this->User->find('first', array('conditions' => array('User.AccountName' => $this->data->AccountName)));

        if(!isset($user) || empty($user) || $user == '') {

            return json_encode(array('error' => 'User doesn\'t exist'));
        }
        else {

            if($this->data->Password == $user['User']['Password']) {

                return json_encode(array('user' => $user['User']));
            }
            else {

                return json_encode(array('error' => 'Incorrect password'));
            }
        }
    }

    public function add() {

        /*$this->data = json_decode('{
            "AccountName": "1234",
            "Password": "1234",
            "FirstName": "John",
            "Surname": "Doe",
            "PhoneNo": "0400000000",
            "Email": "john@example.com",
            "PayPalAccount": "1234",
            "SellerPoints": "1234",
            "BuyerPoints": "1234"
        }');*/

        $user['User']['AccountName'] = $this->data->AccountName;
        $user['User']['Password'] = $this->data->Password;
        $user['User']['FirstName'] = $this->data->FirstName;
        $user['User']['Surname'] = $this->data->Surname;
        $user['User']['PhoneNo'] = $this->data->PhoneNo;
        $user['User']['Email'] = $this->data->Email;
        $user['User']['PayPalAccount'] = $this->data->PayPalAccount;
        $user['User']['SellerPoints'] = 0;
        $user['User']['BuyerPoints'] = 0;

        $this->User->create();
        $result = $this->User->save($user);

        return $this->__respond($result);
    }

    public function edit() {

        return json_encode(array('error' => 'Unused function'));
    }

    private function __respond($result) {

        if(isset($result) && !empty($result) && !is_string($result)) {

            return json_encode(array('user' => $result['User']));
        }
        else {

            return json_encode(array('error' => 'Could not save to database'));
        }
    }
}
