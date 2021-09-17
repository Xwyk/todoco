<?php


namespace App\Tests;


use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

abstract class XwykGetSetTestCase extends TestCase implements XwykGetSetTestCaseInterface
{

    /**
     * @dataProvider loadSetters
     */
    public function testSetter($test){
        $this->setter(
            $test["class"],
            $test["variable"],
            $test["value"]
        );
    }

    public function setter($class, $variable, $value){

        $setter = "set".ucwords($variable);
        $getter = "get".ucwords($variable);
        $object = new $class();
        $object->$setter($value);
        $propertyResult = $object->$getter();
        assertEquals($value, $propertyResult);
    }
}