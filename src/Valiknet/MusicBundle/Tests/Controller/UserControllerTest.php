<?php
namespace Valiknet\MusicBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $client->request('GET', '/uk/user/list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
