<?php

App::uses('Controller', 'Controller');

class UsersController extends Controller {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->autoRender = false;
        
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');

        Router::parseExtensions('json');
    }

    public function add($data = null) {

        /*if(!isset($data) || empty($data) || $data == "") {

            return "No data found";
        }*/

        $data = '{
            "AccountName": "1234",
            "Password": "1234",
            "FirstName": "John",
            "Surname": "Doe",
            "PhoneNo": "0400000000",
            "Email": "john@example.com",
            "PayPalAccount": "1234",
            "SellerPoints": "1234",
            "BuyerPoints": "1234"
        }';

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

        $data = json_decode($data);

        $user['User']['AccountName'] = $data->AccountName;
        $user['User']['Password'] = $data->Password;
        $user['User']['FirstName'] = $data->FirstName;
        $user['User']['Surname'] = $data->Surname;
        $user['User']['PhoneNo'] = $data->PhoneNo;
        $user['User']['Email'] = $data->Email;
        $user['User']['PayPalAccount'] = $data->PayPalAccount;
        $user['User']['SellerPoints'] = $data->SellerPoints;
        $user['User']['BuyerPoints'] = $data->BuyerPoints;

        $this->User->create($user);

        $result = $this->User->save($user);

        if(isset($result) && !empty($result) && !is_string($result)) {

            return "Success";
        }
        else {

            return "Failure";
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
