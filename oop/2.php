<?php


class Person{

    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function sayHello()
    {
        echo "Hello ".$this->format($this->name);
    }

    private function format($name)
    {
        return "<b>$name</b>";
    }

}

$person = new Person("Moin");
// $person->name = "Apple";
$person->format("HELLo");
$person->sayHello();
d($person);