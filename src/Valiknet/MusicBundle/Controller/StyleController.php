<?php
namespace Valiknet\MusicBundle\Controller;

use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Valiknet\MusicBundle\Entity\Style;
use Valiknet\MusicBundle\Form\Type\StyleType;

class StyleController extends Controller
{
    /**
     * This method render list main styles
     *
     * @return array
     *
     * @Template()
     */
    public function listAction()
    {
        $styles = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ValiknetMusicBundle:Style')
                    ->findStyleWithoutParent();

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($this->get('translator')->trans('styles.styles', [], 'style'), $this->get("router")->generate("valiknet_style_list"));

        return [
            "styles" => $styles
        ];
    }

    /**
     * This method return
     *
     * @param  Style $style
     * @return array
     *
     * @Template()
     */
    public function showChildrenAction(Style $style)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($this->get('translator')->trans('styles.styles', [], 'style'), $this->get("router")->generate("valiknet_style_list"));
        $breadcrumbs->addItem($style->getName(), $this->get("router")->generate("valiknet_style_children_list", ["slug" => $style->getSlug()]));

        return [
            "style" => $style
        ];
    }

    /**
     * This method return style by slug
     *
     * @param  Style                                             $style
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function showChildrenPostAction(Style $style)
    {
        $data = $this->get('jms_serializer')->serialize($style, 'json', SerializationContext::create()->enableMaxDepthChecks());

        return new JsonResponse(
            [
                "data" => $data,
            ]
        );
    }

    /**
     * This method render groups target style
     *
     * @param  Style $style
     * @return array
     *
     * @Template()
     */
    public function showGroupAction(Style $style)
    {
        $groups = $this->get('valiknet.service.extend_paginator')->extend($style->getGroups());

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($this->get('translator')->trans('styles.styles', [], 'style'), $this->get("router")->generate("valiknet_style_list"));
        $breadcrumbs->addItem($style->getName(), $this->get("router")->generate("valiknet_style_children_list", ["slug" => $style->getSlug()]));
        $breadcrumbs->addItem($this->get('translator')->trans('styles.navigator.groups', [], 'style'), $this->get("router")->generate("valiknet_style_group_list", ["slug" => $style->getSlug()]));

        return [
            "style" => $style,
            "groups" => $groups
        ];
    }

    /**
     * This method render form for add style
     *
     * @param  Request                                                  $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Template()
     */
    public function createStyleAction(Request $request)
    {
        $em = $this->getDoctrine()
                ->getManager();

        $style = new Style();

        $form = $this->createForm(new StyleType(), $style);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($style);
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "form" => $form->createView()
        ];
    }

    /**
     * This method render form for update style
     *
     * @param  Style                                                    $style
     * @param  Request                                                  $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Template()
     */
    public function updateStyleAction(Style $style, Request $request)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $form = $this->createForm(new StyleType(), $style);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "style" => $style,
            "form" => $form->createView()
        ];
    }
}
