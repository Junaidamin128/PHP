<?php


class Person{

    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    function sayHello()
    {
        echo "Hello ".$this->name;
    }
}

$person = new Person("Moin");

$person->sayHello();
d($person);