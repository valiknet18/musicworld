<?php
namespace Valiknet\MusicBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CountryControllerTest extends WebTestCase
{
    public function testListCountry()
    {
        $client = static::createClient();

        $client->request('GET', '/uk/country/list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testErrorCountry()
    {
        $client = static::createClient();

        $client->request('GET', '/uk/country/-1/view/group');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testErrorUsers()
    {
        $client = static::createClient();

        $client->request('GET', '/uk/country/-1/view/users');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
