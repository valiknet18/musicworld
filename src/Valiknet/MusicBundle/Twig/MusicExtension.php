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
            new \Twig_SimpleFilter('valiknet_role', [$this, "roleFilter"])
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

    public function getName()
    {
        return "valiknet_twig_extension";
    }
}
