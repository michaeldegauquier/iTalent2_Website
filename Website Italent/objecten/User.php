<?php

class User {
    public $Id;
    public $Email;
    public $Password;
    public $Firstname;
    public $Lastname;

    public function __construct($Id, $Email, $Password, $Firstname, $Lastname) {
        $this->Id = $Id;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->Firstname = $Firstname;
        $this->Lastname = $Lastname;
    }
}

?>