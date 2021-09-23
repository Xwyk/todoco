<?php


namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\BrowserKit\Cookie;
use App\Entity\User;


abstract class XwykWebTestCase extends WebTestCase implements XwykWebTestCaseInterface
{

    public function entryPoint($type,
                               $url,
                               $expectedCode,
                               $authenticated = null,
                               $parameters = [],
                               $files = [],
                               $server = [],
                               $content = "")
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
        $crawler = $client->request(
            $type,
            $url,
            $parameters,
            $files,
            $server,
            $content
        );
        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertEquals($expectedCode, $statusCode);
        return $crawler;
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
        );
        if (isset($test['additionalCheck']) && is_array($test['additionalCheck'])) {
            foreach ($test['additionalCheck'] as $method){
                $this->$method($result);
            }
        }
    }
    protected function createUserClient(){
        return $this->createAuthenticatedClient(static::USER_LOGIN);
    }

    protected function createAdminClient(){
        return $this->createAuthenticatedClient(static::ADMIN_LOGIN);
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