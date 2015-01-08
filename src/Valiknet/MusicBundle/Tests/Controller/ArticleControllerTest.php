<?php

namespace Valiknet\MusicBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testArticle()
    {
        $client = static::createClient();

        $client->request('GET', '/uk/article/-1/view');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
