<?php

namespace TE\PlatformBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/register');
    }

    public function testProfile()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/profile');
    }

}
