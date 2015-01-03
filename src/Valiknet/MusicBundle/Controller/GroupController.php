<?php
namespace Valiknet\MusicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Valiknet\MusicBundle\Entity\Clip;
use Valiknet\MusicBundle\Entity\Group;
use Valiknet\MusicBundle\Entity\Release;

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

        $paginator  = $this->get('knp_paginator');
        $groups = $paginator->paginate(
            $groups,
            $request->query->get('page', 1),
            10
        );

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
     * @param Group $group
     * @param Clip $clip
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
     * @param Group $group
     * @param Release $release
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
}
