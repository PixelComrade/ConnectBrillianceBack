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

    public function add() {

        $data = '{
            "JobName": "Job",
            "Description": "Desc",
            "Location": "Loc",
            "Owner": "1",
            "AssignedTo": "2",
            "Charity": "1",
            "CharityAmount": "50",
            "AssignedToAmount": "50",
            "Status": "Listed"
        }';

        /*
        id
        JobName
        Description
        Location
        Owner
        AssignedTo
        Charity
        CharityAmount
        AssignedToAmount
        CharityReceipt
        AssignedToReceipt
        Status (Listed, Accepted, Completed)
        */

        $data = json_decode($data);

        $job['Job']['JobName'] = $this->$data->JobName;
        $job['Job']['Description'] = $this->$data->Description;
        $job['Job']['Location'] = $this->$data->Location;
        $job['Job']['Owner'] = $this->$data->Owner;
        $job['Job']['AssignedTo'] = $this->$data->AssignedTo;
        $job['Job']['Charity'] = $this->$data->Charity;
        $job['Job']['CharityAmount'] = $this->$data->CharityAmount;
        $job['Job']['AssignedToAmount'] = $this->$data->AssignedToAmount;
        $job['Job']['Status'] = $this->$data->Status;

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
