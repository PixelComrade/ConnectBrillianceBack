<?php

App::uses('Controller', 'Controller');

class JobsController extends Controller {

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function fetch() {

        $data = $this->Jobs->find('all');
        return json_encode($data);
    }

    public function add($data = null) {

        /*if(!isset($data) || empty($data) || $data == "") {

            return "No data found";
        }*/

        $data = '{
            "Description": "Desc",
            "Location": "Loc",
            "Value": "10",
            "Owner": "1",
            "AssignedTo": "2",
            "Charity": "3",
            "Breakdown": "50",
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
        $job['Job']['Breakdown'] = $data->Breakdown;
        $job['Job']['Status'] = $data->Status;

        $this->Job->create();

        $result = $this->Job->save($job);

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
