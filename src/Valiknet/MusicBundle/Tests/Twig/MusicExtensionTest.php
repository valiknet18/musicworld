<?php
namespace Valiknet\MusicBundle\Tests\Twig;

use Valiknet\MusicBundle\Twig\MusicExtension;

class MusicExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider roleProvider
     */
    public function testRoleFilter($result, $idRole)
    {
        $roleFilter = new MusicExtension();

        $this->assertEquals($result, $roleFilter->roleFilter($idRole));
    }

    public function roleProvider()
    {
        return [
            [
                "Гітарист(-ка)", 0,
            ],
            [
                "Барабанщик", 1
            ],
            [
                "Басист(-ка)", 2
            ],
            [
                "Вокаліст(-ка)", 3
            ],
            [
                "Клавішнік(-ца)", 4
            ],
            [
                "Ді-джей(-ка)", 5
            ],
            [
                "Саксофоніст(-ка)", 6
            ],
            [
                "Вибрана роль не вірна", 7
            ],
            [
                "Вибрана роль не вірна", 8
            ]
        ];
    }

    /**
     * @param $result
     * @param $idRelease
     *
     * @dataProvider releaseProvider
     */
    public function testReleaseFilter($result, $idRelease)
    {
        $releaseFilter = new MusicExtension();

        $this->assertEquals($result, $releaseFilter->releaseFilter($idRelease));
    }

    public function releaseProvider()
    {
        return [
            [
                "Album", 0,
            ],
            [
                "Single", 1
            ],
            [
                "Remixer", 2
            ],
            [
                "EP(Extended Play)", 3
            ],
            [
                "Compilation", 4
            ],
            [
                "Soundtrack", 5
            ],
            [
                "Live", 6
            ],
            [
                "Promo", 8
            ],
            [
                "Demo", 10
            ],
            [
                "Такого типу релізу немає", 11
            ]
        ];
    }

    public function testImageFilter()
    {
        $imageFilter = new MusicExtension();

        $this->assertEquals("standart/group/empty.png", $imageFilter->imageFilter(""));
    }

    /**
     * @dataProvider languageProvider
     */
    public function testTargetLanguageFunction($result, $route)
    {
        $languageFunction = new MusicExtension();
        $this->assertEquals($result, $languageFunction->targetLanguageFunction($route));
    }

    public function languageProvider()
    {
        return [
            [
                "EN", [
                    "_locale" => "en"
                ],
                "RU", [
                    "_locale" => "ru"
                ],
                "UK", [
                    "_locale" => "uk"
                ]
            ]
        ];
    }
}
