<?php
namespace Valiknet\MusicBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GroupControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $client->request('GET', '/uk/group/list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testErrorList()
    {
        $client = static::createClient();

        $client->request('GET', '/uk/group/-0/view');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
