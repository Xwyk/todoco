<?php


namespace TestBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

abstract class TodoWebTestCase extends WebTestCase implements TodoWebTestCaseInterface
{
    public function entryPoint($type, $url, $expectedCode, $parameters = [], $files = [], $server = [], $content = "", $needReturnOnOK = false)
    {
        self::ensureKernelShutdown();
        $client = self::createClient();
        $client->request(
            $type,
            $url,
            $parameters,
            $files,
            $server,
            $content
        );
        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertEquals($expectedCode, $statusCode);
        return (($needReturnOnOK) && ($client->getResponse()->getStatusCode() == $expectedCode)) ?
            ($client->getResponse()->getContent()) :
            null;
    }

    /**
     * @dataProvider loadEntryPoints
     */
    public function testEntryPoints($test)
    {
        if (!isset($this->token) && $test['authenticated']){
        }
        $result = $this->entryPoint(
            $test['type'],
            $test['url'],
            $test['expectedCode'],
            $test['parameters'],
            $test['files'],
            $test['server'],
            $test['content'],
            $test['needReturnOnOK']
        );
        if ($test['needReturnOnOK'] && isset($test['additionalCheck'])) {
            $method = $test['additionalCheck'];
            $this->$method($result);
        }
    }
}