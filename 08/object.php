<?php
class Cat {
    private $name = "alice";
    private $age = 4;
    public static $count = 0;
    public const NUM = 12;
    
    function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
        static::$count++;
        echo Cat::NUM;
    }

    function getName() {
        return $this->name;
    }
    
}

class SpecialCat extends Cat
{

}
var_dump(Cat::$count);
$cat1 = new Cat("test", 2);
var_dump(Cat::$count);
$cat2 = new SpecialCat("test2", 12);
var_dump(SpecialCat::$count);