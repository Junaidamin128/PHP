<?php
namespace NameAgePerson;

class Person
{
    public $name;
    public $age;
    public function __construct($name, $age)
    {
        $this->name = $name;   
        $this->age = $age;   
    }
}