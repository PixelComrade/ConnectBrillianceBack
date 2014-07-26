<?php

App::uses('Controller', 'Controller');

class JobsController extends Controller {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->autoRender = false;

        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');

        Router::parseExtensions('json');
    }

    public function fetch() {

        $data = $this->Jobs->find('all');
        return json_encode($data);
    }

    public function add($data) {

        if(!isset($data) || empty($data) || $data == "") {

            return "No data found";
        }

        /*
        id
        Description
        Location
        Value
        Owner
        AssignedTo
        Charity
        Breakdown
        Status (Listed, Accepted, Completed)
        */

        $data = json_decode($data);

        $user['User']['AccountName'] = $data->AccountName;
        $user['User']['FirstName'] = $data->FirstName;
        $user['User']['Surname'] = $data->Surname;
        $user['User']['PhoneNo'] = $data->PhoneNo;
        $user['User']['Email'] = $data->Email;
        $user['User']['PayPalAccount'] = $data->PayPalAccount;
        $user['User']['SellerPoints'] = $data->SellerPoints;
        $user['User']['BuyerPoints'] = $data->BuyerPoints;

        $this->User->create();

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

    public function complete() {

        $message = 'Complete';
        return $message;
    }
}
