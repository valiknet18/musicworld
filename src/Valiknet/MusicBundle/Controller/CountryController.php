<?php
namespace Valiknet\MusicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Valiknet\MusicBundle\Entity\Country;
use Valiknet\MusicBundle\Form\Type\CountryType;

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

        $countries = $this->get('valiknet.service.extend_paginator')->extend($countries);

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

    /**
     * This method render form for create country
     *
     * @param  Request                                                  $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Template()
     */
    public function createCountryAction(Request $request)
    {
        $em = $this->getDoctrine()
                ->getManager();

        $country = new Country();

        $form = $this->createForm(new CountryType(), $country);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($country);
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "form" => $form->createView()
        ];
    }

    /**
     * This method render form for update country
     *
     * @param  Country                                                  $country
     * @param  Request                                                  $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Template()
     */
    public function updateCountryAction(Country $country, Request $request)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $form = $this->createForm(new CountryType(), $country);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($country);
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "country" => $country,
            "form" => $form->createView()
        ];
    }
}
