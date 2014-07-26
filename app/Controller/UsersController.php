<?php

App::uses('Controller', 'Controller');

class UsersController extends Controller {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Methods', '*');
        $this->response->header('Access-Control-Allow-Headers', 'X-Requested-With');
        $this->response->header('Access-Control-Allow-Headers', 'Content-Type, x-xsrf-token');
        $this->response->header('Access-Control-Max-Age', '172800');
        Router::parseExtensions('json');

        $this->data = $this->request->input('json_decode');
    }

    public function add() {

        if(!isset($this->data) || empty($this->data) || $this->data == "") {

            return json_encode(array('error' => 'No data found'));
        }

        /*$this->data = '{
            "AccountName": "1234",
            "Password": "1234",
            "FirstName": "John",
            "Surname": "Doe",
            "PhoneNo": "0400000000",
            "Email": "john@example.com",
            "PayPalAccount": "1234",
            "SellerPoints": "1234",
            "BuyerPoints": "1234"
        }';*/

        /*
        id
        AccountName
        Password
        FirstName
        Surname
        PhoneNo
        Email
        PayPalAccount
        SellerPoints
        BuyerPoints
        */

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

        if(isset($result) && !empty($result) && !is_string($result)) {

            return json_encode(array('AccountName' => $result['User']['AccountName']));
        }
        else {

            return json_encode(array('error' => 'Could not save to database'));
        }
    }

    public function edit() {

        $message = 'Edit';
        return $message;
    }

    public function remove() {

        $message = 'Remove';
        return $message;
    }
}
