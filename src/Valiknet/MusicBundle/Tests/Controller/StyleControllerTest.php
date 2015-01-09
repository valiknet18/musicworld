<?php
namespace Valiknet\MusicBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StyleControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $client->request('GET', '/uk/genre/list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
