<?php

App::uses('Controller', 'Controller');

class JobsController extends Controller {

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

        if(!isset($this->data) || empty($this->data) || $this->data == "") {

            return json_encode(array('error' => 'No data found'));
        }
    }

    public function fetch() {

        $data = $this->Jobs->find('all');
        return json_encode($data);
    }

    public function add($data = null) {

        $data = '{
            "Description": "Desc",
            "Location": "Loc",
            "Value": "10",
            "Owner": "1",
            "AssignedTo": "2",
            "Charity": "1",
            "CharityAmount": "50",
            "AssignedToAmount": "50",
            "Status": "Listed"
        }';

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

        $job['Job']['Description'] = $data->Description;
        $job['Job']['Location'] = $data->Location;
        $job['Job']['Value'] = $data->Value;
        $job['Job']['Owner'] = $data->Owner;
        $job['Job']['AssignedTo'] = $data->AssignedTo;
        $job['Job']['Charity'] = $data->Charity;
        $job['Job']['CharityAmount'] = $data->CharityAmount;
        $job['Job']['AssignedToAmount'] = $data->AssignedToAmount;
        $job['Job']['Status'] = $data->Status;

        $this->Job->create();

        $result = $this->Job->save($job);

        if(isset($result) && !empty($result) && !is_string($result)) {

            return json_encode(array('Owner' => $result['Job']['Owner']));
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

    public function complete() {

        $message = 'Complete';
        return $message;
    }
}
