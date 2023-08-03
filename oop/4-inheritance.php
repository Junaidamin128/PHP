<?php


class Vehichle{
    private $number;
    public function __construct($number)
    {
        $this->number = $number;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getNum2()
    {
        return $this->getNumber();
    }
}

class Tesla extends Vehichle{
    
    private $battery;
    
    public function __construct($number, $battery)
    {
        parent::__construct($number);
        $this->battery = $battery;
    }
    
    public function changeNumber($number)
    {
        $this->number = $number;
    }

    public function getNumber()
    {
        return "T-".$this->number;
    }
}

$v1 = new Tesla("123123", 4);
// $v1->changeNumber("abcde");
d($v1);