<?php


namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\BrowserKit\Cookie;
use App\Entity\User;


abstract class TodoWebTestCase extends WebTestCase implements TodoWebTestCaseInterface
{
    const DEFAULT_USER_LOGIN  = "user1";
    const DEFAULT_ADMIN_LOGIN = "admin2";

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
        return $this->createAuthenticatedClient(self::DEFAULT_USER_LOGIN);
    }

    protected function createAdminClient(){
        return $this->createAuthenticatedClient(self::DEFAULT_ADMIN_LOGIN);
    }

    protected function createAuthenticatedClient($username){
        $client = static::createClient();
        $user = (static::getContainer()->get(UserRepository::class)->createQueryBuilder('u')
            ->where("u.username = :username")
            ->setParameter('username', $username)
            ->getQuery()
            ->getResult())[0];
        $client->loginUser($user);
        return $client;
    }
}