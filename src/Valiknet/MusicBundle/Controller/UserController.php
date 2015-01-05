<?php
namespace Valiknet\MusicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Valiknet\MusicBundle\Entity\User;
use Valiknet\MusicBundle\Form\Type\AddUserType;

class UserController extends Controller
{
    /**
     * This method render list of all users
     *
     * @param  Request $request
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
     * @param  User  $user
     * @return array
     *
     * @Template()
     */
    public function showAction(User $user)
    {
        return [
            "user" => $user
        ];
    }

    /**
     * This method render list groups user
     *
     * @param  User  $user
     * @return array
     *
     * @Template()
     */
    public function listGroupsAction(User $user)
    {
        return [
            "user" => $user
        ];
    }

    /**
     * This method render list news user
     *
     * @param  User  $user
     * @return array
     *
     * @Template()
     */
    public function listNewsAction(User $user)
    {
        return [
            "user" => $user
        ];
    }

    /**
     * This method render contact list
     *
     * @param  User  $user
     * @return array
     *
     * @Template()
     */
    public function contactsAction(User $user)
    {
        return [
            "user" => $user
        ];
    }

    /**
     * This method render form for add user
     *
     * @param  Request $request
     * @return array
     *
     * @Template()
     */
    public function addUserAction(Request $request)
    {
        $em = $this->getDoctrine()
                ->getManager();

        $user = new User();

        $form = $this->createForm(new AddUserType(), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($user);
            $em->flush();
        }

        return [
            "form" => $form->createView()
        ];
    }
}
