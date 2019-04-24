<?php

class Product {
    public $Id;
    public $Name;
    public $Price;
    public $Category;
    public $Description;
    public $Image;

    public function __construct($Id, $Name, $Price, $Category, $Description, $Image) {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->Price = $Price;
        $this->Category = $Category;
        $this->Description = $Description;
        $this->Image = $Image;
    }
}

?>