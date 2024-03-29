<?php

class User {
    private $id;
    private $username;
    private $password;
    private $firstname;
    private $lastname;
    private $permission;
    private $updated_at;

    public function read($id, $username, $password, $firstname, $lastname, $permission, $updated_at){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->permission = $permission;
        $this->updated_at = $updated_at;
    }

    public function create($username, $password, $firstname, $lastname, $permission){
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->permission = $permission;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function save(){
        if(UserFactory::find($this->username) == NULL){
            $user = UserFactory::insert($this->username, $this->password, $this->firstname, $this->lastname, $this->permission);
            if($user != NULL){
                $this->id = $user->id;
                $this->updated_at = $user->updated_at;
            }
        }
    }
}