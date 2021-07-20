<?php


namespace TestBundle;

interface TodoWebTestCaseInterface
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
        $content = "",
        $needReturnOnOK = false
    );
}