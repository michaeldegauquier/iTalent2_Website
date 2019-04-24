<?php

class Orders {
    public $Id;
    public $UserEmail;
    public $ProductName;
    public $OrderDate;

    public function __construct($Id, $UserEmail, $ProductName, $OrderDate) {
        $this->Id = $Id;
        $this->UserEmail = $UserEmail;
        $this->ProductName = $ProductName;
        $this->OrderDate = $OrderDate;
    }
}

?>