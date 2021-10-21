<?php

namespace App\Tests;

use function PHPUnit\Framework\assertEquals;
use PHPUnit\Framework\TestCase;

/**
 * Class MethodTestCase.
 *
 * @codeCoverageIgnore
 */
abstract class MethodTestCase extends TestCase implements MethodTestCaseInterface
{
    /**
     * @dataProvider loadTests
     */
    public function testSetter($test)
    {
        $this->setter(
            $test['class'],
            $test['variable'],
            $test['value']
        );
    }

    public function setter($class, $method, $value)
    {
        /*
                $setter = "set".ucwords($variable);
                $getter = "get".ucwords($variable);
                $object = new $class();
                $object->$method($value);
                assertEquals($value, $propertyResult);
            */
    }
}
