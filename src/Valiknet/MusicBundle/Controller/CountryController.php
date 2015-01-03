<?php
namespace Valiknet\MusicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Valiknet\MusicBundle\Entity\Country;

class CountryController extends Controller
{
    /**
     * This method render all list country
     *
     * @param  Request $request
     * @return array
     *
     * @Template()
     */
    public function listAction(Request $request)
    {
        $countries = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('ValiknetMusicBundle:Country')
                        ->findAll();

        $paginator  = $this->get('knp_paginator');
        $countries = $paginator->paginate(
            $countries,
            $request->query->get('page', 1),
            10
        );

        return [
            "countries" => $countries
        ];
    }

    /**
     * This method render all group by city
     *
     * @param  Country $country
     * @param  Request $request
     * @return array
     *
     * @Template()
     */
    public function showGroupAction(Country $country, Request $request)
    {
        return [
            "country" => $country
        ];
    }

    /**
     * This method render all user by country
     *
     * @param  Country $country
     * @param  Request $request
     * @return array
     *
     * @Template()
     */
    public function showUserAction(Country $country, Request $request)
    {
        return [
            "country" => $country
        ];
    }
}
