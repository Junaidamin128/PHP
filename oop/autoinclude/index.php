<?php


spl_autoload_register(function($class){
        require $class.".php";
});

$ob = new \NamePerson\Person("Moin");
$ob1 = new \NameAgePerson\Person("Moin", 124);
d($ob);
d($ob1);
