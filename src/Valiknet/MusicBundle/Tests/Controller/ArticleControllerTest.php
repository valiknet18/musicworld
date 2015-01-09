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

    /**
     * @dataProvider provider
     */
    public function testNavigator($url, $text)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $url);

        $textArray = explode("|", $text);

        for ($i = 0; $i < count($textArray); $i++) {
            $this->assertTrue($crawler->filter('html:contains('.$textArray[$i].')')->count() > 0);
        }
    }

    public function provider()
    {
        return [
            [
                "/", "Статті|Групи|Люди|Стилі|Країни",
                "/ru", "Статьи|Группы|Люди|Стили|Страны",
                "/en", "Articles|Groups|Users|Genres|Countries",
            ]
        ];
    }

    public function testErrorArticle()
    {
        $client = static::createClient();

        $client->request('GET', '/uk/article/-1/view');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
