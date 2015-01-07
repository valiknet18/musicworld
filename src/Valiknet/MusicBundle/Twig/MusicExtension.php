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
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('valiknet_role', [$this, "roleFilter"]),
            new \Twig_SimpleFilter('valiknet_release', [$this, "releaseFilter"]),
        ];
    }

    public function roleFilter($number)
    {
        switch ($number) {
            case 1:
                return "Гітарист(-ка)";
                break;

            case 2:
                return "Барабанщик";
                break;

            case 3:
                return "Басист(-ка)";
                break;

            case 4:
                return "Вокаліст(-ка)";
                break;

            case 5:
                return "Клавішнік(-ца)";
                break;

            case 6:
                return "Ді-джей(-ка)";
                break;

            case 7:
                return "Саксофоніст(-ка)";
                break;

            default:
                return "Вибрана роль не вірна";
        }
    }

    public function releaseFilter($number)
    {
        switch ($number) {
            case 1:
                return "Album";
            break;

            case 2:
                return "Single";
            break;

            case 3:
                return "Remixer";
            break;

            case 4:
                return "EP(Extended Play)";
            break;

            case 5:
                return "Compilation";
            break;

            case 6:
                return "Soundtrack";

            case 7:
                return "Live";
            break;

            case 8:
                return "Bootleg";
            break;

            case 9:
                return "Promo";
            break;

            case 10:
                return "Tribute(cover)";
            break;

            case 11:
                return "Demo";
            break;

            default:
                return "Такого типу релізу немає";
        }
    }

    public function getName()
    {
        return "valiknet_twig_extension";
    }
}
