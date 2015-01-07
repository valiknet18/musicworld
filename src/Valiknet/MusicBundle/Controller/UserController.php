<?php
namespace Valiknet\MusicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Valiknet\MusicBundle\Entity\GroupUser;
use Valiknet\MusicBundle\Entity\User;
use Valiknet\MusicBundle\Form\Type\GroupUserType;
use Valiknet\MusicBundle\Form\Type\UserType;

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

        $users = $this->get('valiknet.service.extend_paginator')->extend($users);

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

        $form = $this->createForm(new UserType(), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "form" => $form->createView()
        ];
    }

    /**
     * This method render form for update user
     *
     * @param  User    $user
     * @param  Request $request
     * @return array
     *
     * @Template()
     */
    public function updateUserAction(User $user, Request $request)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $form = $this->createForm(new UserType(), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "form" => $form->createView(),
            "user" => $user
        ];
    }

    /**
     * This method render form for add user in group
     *
     * @param  User                                                     $user
     * @param  Request                                                  $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Template()
     */
    public function addUserInGroupAction(User $user, Request $request)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $groupUser = new GroupUser();

        $form = $this->createForm(new GroupUserType(), $groupUser);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $groupUser->setUser($user);

            $em->persist($groupUser);
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "form" => $form->createView(),
            "user" => $user
        ];
    }

    /**
     * This method render form for update user in group
     *
     * @param  User                                                     $user
     * @param  GroupUser                                                $groupUser
     * @param  Request                                                  $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Template()
     */
    public function updateUserInGroupAction(User $user, GroupUser $groupUser, Request $request)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $form = $this->createForm(new GroupUserType(), $groupUser);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "form" => $form->createView(),
            "user" => $user,
            "groupUser" => $groupUser
        ];
    }

    public function deleteUserInGroupAction(User $user, GroupUser $groupUser)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $em->remove($groupUser);
        $em->flush();

        return $this->redirectToRoute('valiknet_home');
    }
}
