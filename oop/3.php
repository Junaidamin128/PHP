<?php


class Person{

    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function sayHello()
    {
        echo "Hello ".$this->format($this->name);
    }

    protected function format($name)
    {
        return "<b>$name</b>";
    }

}

$person = new Person("Moin");
// $person->name = "Apple";
$person->format("HELLo");
$person->sayHello();
d($person);