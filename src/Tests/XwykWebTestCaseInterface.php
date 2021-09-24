<?php


namespace App\Tests;
/**
 * Interface XwykWebTestCaseInterface
 * @package App\Tests
 * @codeCoverageIgnore
 */
interface XwykWebTestCaseInterface
{
    public function loadEntryPoints();
    public function testEntryPoints($test);
    public function entryPoint(
        $type,
        $url,
        $expectedCode,
        $authenticated = null,
        $parameters = [],
        $files = [],
        $server = [],
        $content = ""
    );
}