<?php

App::uses('Model', 'Model');

class User extends Model {

    public function beforeSave($options = array()) {
        parent::beforeSave($options = array());
        if(isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
   }
}
