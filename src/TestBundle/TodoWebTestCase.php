<?php


namespace TestBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\BrowserKit\Cookie;
use AppBundle\Entity\User;


abstract class TodoWebTestCase extends WebTestCase implements TodoWebTestCaseInterface
{
    const defaultUserLogin = "user1";
    const defaultUserPassword = "user1";
    const defaultAdminLogin = "admin1";
    const defaultAdminPassword = "admin1";

    public function entryPoint($type,
                               $url,
                               $expectedCode,
                               $authenticated = null,
                               $parameters = [],
                               $files = [],
                               $server = [],
                               $content = "",
                               $needReturnOnOK = false)
    {
        self::ensureKernelShutdown();
        switch ($authenticated){
            case "ADMIN":
                $client = $this->createAdminClient();
                break;
            case "USER":
                $client = $this->createUserClient();
                break;
            default:
                $client = self::createClient();
                break;
        }
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
        $result = $this->entryPoint(
            $test['type'],
            $test['url'],
            $test['expectedCode'],
            $test['authenticated'],
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
    protected function createUserClient(){
        return $this->createAuthenticatedClient(self::defaultUserLogin);
    }

    protected function createAdminClient(){
        return $this->createAuthenticatedClient(self::defaultAdminLogin);
    }

    protected function createAuthenticatedClient($username){
        $client = static::createClient();
        $container = static::$kernel->getContainer();
        $session = $container->get('session');
        $person = self::$kernel->getContainer()->get('doctrine')->getRepository('AppBundle:user')->findOneByUsername($username);

        $token = new UsernamePasswordToken($person, null, 'main', $person->getRoles());
        $session->set('_security_main', serialize($token));
        $session->save();

        $client->getCookieJar()->set(new Cookie($session->getName(), $session->getId()));
        return $client;
    }
}