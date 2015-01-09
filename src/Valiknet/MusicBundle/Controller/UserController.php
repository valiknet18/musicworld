<?php
namespace Valiknet\MusicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($this->get('translator')->trans('users.users', [], 'user'), $this->get("router")->generate("valiknet_user_list"));

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
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($this->get('translator')->trans('users.users', [], 'user'), $this->get("router")->generate("valiknet_user_list"));
        $breadcrumbs->addItem($user->getName()." ".$user->getLastname(), $this->get("router")->generate("valiknet_user_view", ["slug" => $user->getSlug()]));

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
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($this->get('translator')->trans('users.users', [], 'user'), $this->get("router")->generate("valiknet_user_list"));
        $breadcrumbs->addItem($user->getName()." ".$user->getLastname(), $this->get("router")->generate("valiknet_user_view", ["slug" => $user->getSlug()]));
        $breadcrumbs->addItem($this->get('translator')->trans('users.navigator.groups', [], 'user'), $this->get("router")->generate("valiknet_user_groups_list", ["slug" => $user->getSlug()]));

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
        $articles = $this->get('valiknet.service.extend_paginator')->extend($user->getNews());

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($this->get('translator')->trans('users.users', [], 'user'), $this->get("router")->generate("valiknet_user_list"));
        $breadcrumbs->addItem($user->getName()." ".$user->getLastname(), $this->get("router")->generate("valiknet_user_view", ["slug" => $user->getSlug()]));
        $breadcrumbs->addItem($this->get('translator')->trans('users.navigator.news', [], 'user'), $this->get("router")->generate("valiknet_user_news_list", ["slug" => $user->getSlug()]));

        return [
            "user" => $user,
            "articles" => $articles
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
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($this->get('translator')->trans('users.users', [], 'user'), $this->get("router")->generate("valiknet_user_list"));
        $breadcrumbs->addItem($user->getName()." ".$user->getLastname(), $this->get("router")->generate("valiknet_user_view", ["slug" => $user->getSlug()]));
        $breadcrumbs->addItem($this->get('translator')->trans('users.navigator.contacts', [], 'user'), $this->get("router")->generate("valiknet_user_contacts", ["slug" => $user->getSlug()]));

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
     * @ParamConverter("user", options={"mapping": {"slug": "slug"}})
     * @ParamConverter("group_user", options={"mapping": {"id": "id"}})
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

    /**
     * This method render user from group
     *
     * @param  User                                               $user
     * @param  GroupUser                                          $groupUser
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @ParamConverter("user", options={"mapping": {"slug": "slug"}})
     * @ParamConverter("group_user", options={"mapping": {"id": "id"}})
     */
    public function deleteUserInGroupAction(User $user, GroupUser $groupUser)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $em->remove($groupUser);
        $em->flush();

        return $this->redirectToRoute('valiknet_home');
    }
}
