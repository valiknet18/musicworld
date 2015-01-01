<?php
namespace Valiknet\MusicBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GroupControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $client->request('GET', '/ua/group/list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
