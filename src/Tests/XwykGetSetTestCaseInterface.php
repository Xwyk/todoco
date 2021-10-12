<?php

namespace App\Tests;

/**
 * Interface XwykGetSetTestCaseInterface.
 *
 * @codeCoverageIgnore
 */
interface XwykGetSetTestCaseInterface
{
    /**
     * Load list of all setters.
     *
     * @return mixed
     */
    public function loadSetters();

    /**
     * Prepare test for one set/getter.
     *
     * @param $setter array
     *
     * @return mixed
     */
    public function testSetter($setter);

    /**
     * Instanciate test.
     *
     * @param $class string Object class to instanciate (ex : User::class)
     * @param $variable string variable name to test (ex : username)
     * @param $value mixed value to assert
     *
     * @return mixed
     */
    public function setter(
        $class,
        $variable,
        $value
    );
}
