<?php
namespace Valiknet\MusicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Valiknet\MusicBundle\Entity\Clip;
use Valiknet\MusicBundle\Entity\Group;
use Valiknet\MusicBundle\Entity\Release;
use Valiknet\MusicBundle\Form\Type\AddClipType;
use Valiknet\MusicBundle\Form\Type\AddGroupType;
use Valiknet\MusicBundle\Form\Type\AddReleaseType;
use Valiknet\MusicBundle\Form\Type\ClipType;
use Valiknet\MusicBundle\Form\Type\UpdateGroupType;
use Valiknet\MusicBundle\Form\Type\UpdateReleaseType;

class GroupController extends Controller
{
    /**
     * This method render list of groups
     *
     * @param  Request $request
     * @return array
     *
     * @Template()
     */
    public function listAction(Request $request)
    {
        $groups = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('ValiknetMusicBundle:Group')
                        ->findBy([], ['name' => 'ASC']);

        $groups = $this->get('valiknet.service.extend_paginator')->extend($groups);

        return [
            "groups" => $groups
        ];
    }

    /**
     * This method render info about group
     *
     * @param  Group $group
     * @return array
     *
     * @Template()
     */
    public function viewAction(Group $group)
    {
        return [
            "group" => $group
        ];
    }

    /**
     * This method render list of clips
     *
     * @param  Group $group
     * @return array
     *
     * @Template()
     */
    public function listClipAction(Group $group)
    {
        return [
            "group" => $group
        ];
    }

    /**
     * This method render target clip
     *
     * @param  Group $group
     * @param  Clip  $clip
     * @return array
     *
     * @Template()
     * @ParamConverter("clip", options={"mapping": {"slugClip": "slug"}})
     */
    public function clipAction(Group $group, Clip $clip)
    {
        return [
            "group" => $group,
            "clip" => $clip
        ];
    }

    /**
     * This method render list of all releases group
     *
     * @param  Group $group
     * @return array
     *
     * @Template()
     */
    public function listReleaseAction(Group $group)
    {
        return [
            "group" => $group
        ];
    }

    /**
     * This method render target release
     *
     * @param  Group   $group
     * @param  Release $release
     * @return array
     *
     * @Template()
     * @ParamConverter("release", options={"mapping": {"slugRelease": "slug"}})
     */
    public function releaseAction(Group $group, Release $release)
    {
        return [
            "group" => $group,
            "release" => $release
        ];
    }

    /**
     * This method render players list
     *
     * @param  Group $group
     * @return array
     *
     * @Template()
     */
    public function playersAction(Group $group)
    {
        return [
            'group' => $group
        ];
    }

    /**
     * This method render contact page
     *
     * @param  Group $group
     * @return array
     *
     * @Template()
     */
    public function contactsAction(Group $group)
    {
        return [
            "group" => $group
        ];
    }

    /**
     * This method render list news
     *
     * @param  Group $group
     * @return array
     *
     * @Template()
     */
    public function listNewsAction(Group $group)
    {
        return [
            "group" => $group
        ];
    }

    /**
     * This method render form for create group
     *
     * @param  Request $request
     * @return array
     *
     * @Template()
     */
    public function createGroupAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $group = new Group();

        $form = $this->createForm(new AddGroupType(), $group);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($group);
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "form" => $form->createView()
        ];
    }

    /**
     * This method render form for update group
     *
     * @param  Group   $group
     * @param  Request $request
     * @return array
     *
     * @Template()
     */
    public function updateGroupAction(Group $group, Request $request)
    {
        $form = $this->createForm(new UpdateGroupType(), $group);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()
                ->getManager()
                ->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "group" => $group,
            "form" => $form->createView()
        ];
    }

    /**
     * This method render form for create release
     *
     * @param  Group                                                    $group
     * @param  Request                                                  $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Template()
     */
    public function addReleaseAction(Group $group, Request $request)
    {
        $em = $this->getDoctrine()
                ->getManager();

        $release = new Release();

        $form = $this->createForm(new AddReleaseType(), $release);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $release->setGroup($group);

            $tracks = $form->getData()->getTracks();

            foreach ($tracks as $track) {
                $track->setRelease($release);
            }

            $em->persist($release);
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "group" => $group,
            "form" => $form->createView()
        ];
    }

    /**
     * This method render target release
     *
     * @param  Group   $group
     * @param  Release $release
     * @return array
     *
     * @Template()
     * @ParamConverter("release", options={"mapping": {"slugRelease": "slug"}})
     */
    public function updateReleaseAction(Group $group, Release $release, Request $request)
    {
        $em = $this->getDoctrine()
                ->getManager();

        $form = $this->createForm(new UpdateReleaseType(), $release);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $tracks = $form->get('tracks')->getData();

            foreach ($tracks as $track) {
                $track->setRelease($release);
                $em->persist($track);
            }

            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "group" => $group,
            "release" => $release,
            "form" => $form->createView()
        ];
    }

    /**
     * This method render form for add clip to group
     *
     * @param  Group                                                    $group
     * @param  Request                                                  $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Template()
     */
    public function addClipAction(Group $group, Request $request)
    {
        $em = $this->getDoctrine()
                ->getManager();

        $clip = new Clip();

        $form = $this->createForm(new AddClipType(), $clip);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $clip->setGroup($group);

            $em->persist($clip);
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "form" => $form->createView(),
            "group" => $group
        ];
    }

    /**
     * This method render form for update clip
     *
     * @param  Group                                                    $group
     * @param  Clip                                                     $clip
     * @param  Request                                                  $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Template()
     * @ParamConverter("clip", options={"mapping": {"slugClip": "slug"}})
     */
    public function updateClipAction(Group $group, Clip $clip, Request $request)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $form = $this->createForm(new ClipType(), $clip);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "form" => $form->createView(),
            "group" => $group,
            "clip" => $clip
        ];
    }
}
