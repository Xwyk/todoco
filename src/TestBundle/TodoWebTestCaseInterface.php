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
        $parameters = [],
        $files = [],
        $server = [],
        $content = "",
        $needReturnOnOK = false
    );
}