<?php
namespace Valiknet\MusicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * This method render list of all users
     *
     * @param Request $request
     * @return array
     *
     * @Template()
     */
    public function listAction(Request $request)
    {
        $users = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ValiknetMusicBundle:User')
                    ->findAll();

        $paginator  = $this->get('knp_paginator');
        $users = $paginator->paginate(
            $users,
            $request->query->get('page', 1),
            10
        );

        return [
            "users" => $users
        ];
    }

    /**
     * This method render user by slug
     *
     * @param $slug
     * @return array
     *
     * @Template()
     */
    public function showAction($slug)
    {
        $user = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ValiknetMusicBundle:User')
                    ->findOneBySlug($slug);

        if (!$user) {
            throw new NotFoundHttpException('Такой людини немає в базі');
        }

        return [
            "user" => $user
        ];
    }
}
