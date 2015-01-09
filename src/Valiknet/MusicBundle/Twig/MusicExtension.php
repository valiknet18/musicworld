<?php
/**
 * Created by PhpStorm.
 * User: valik-pc
 * Date: 07.01.15
 * Time: 19:22
 */

namespace Valiknet\MusicBundle\Twig;

class MusicExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('valiknet_target_language', [$this, "targetLanguageFunction"])
        ];
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('valiknet_role', [$this, "roleFilter"]),
            new \Twig_SimpleFilter('valiknet_release', [$this, "releaseFilter"]),
            new \Twig_SimpleFilter('valiknet_image', [$this, "imageFilter"]),
        ];
    }

    public function roleFilter($number)
    {
        switch ($number) {
            case 0:
                return "Гітарист(-ка)";
                break;

            case 1:
                return "Барабанщик";
                break;

            case 2:
                return "Басист(-ка)";
                break;

            case 3:
                return "Вокаліст(-ка)";
                break;

            case 4:
                return "Клавішнік(-ца)";
                break;

            case 5:
                return "Ді-джей(-ка)";
                break;

            case 6:
                return "Саксофоніст(-ка)";
                break;

            default:
                return "Вибрана роль не вірна";
        }
    }

    public function releaseFilter($number)
    {
        switch ($number) {
            case 0:
                return "Album";
            break;

            case 1:
                return "Single";
            break;

            case 2:
                return "Remixer";
            break;

            case 3:
                return "EP(Extended Play)";
            break;

            case 4:
                return "Compilation";
            break;

            case 5:
                return "Soundtrack";

            case 6:
                return "Live";
            break;

            case 7:
                return "Bootleg";
            break;

            case 8:
                return "Promo";
            break;

            case 9:
                return "Tribute(cover)";
            break;

            case 10:
                return "Demo";
            break;

            default:
                return "Такого типу релізу немає";
        }
    }

    public function imageFilter($image)
    {
        if (empty($image)) {
            return "standart/group/empty.png";
        }

        return $image;
    }

    public function targetLanguageFunction($route)
    {
        if ($route["_locale"] == "uk") {
            return "UK";
        } elseif ($route["_locale"] == "ru") {
            return "RU";
        } else {
            return "EN";
        }
    }

    public function getName()
    {
        return "valiknet_twig_extension";
    }
}
