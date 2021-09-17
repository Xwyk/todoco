<?php


namespace App\Tests;


interface MethodTestCaseInterface
{
    /**
     * Load list of all tests
     * @return mixed
     */
    public function loadTests();

    /**
     * Prepare test for one set/getter
     * @param $method array
     * @return mixed
     */
    public function testMethod($method);

    /**
     * Instanciate test
     * @param $class string Object class to instanciate (ex : User::class)
     * @param $method string method name to test (ex : username)
     * @param $value mixed value to assert
     * @return mixed
     */
    public function setter(
        $class,
        $method,
        $value
    );
}