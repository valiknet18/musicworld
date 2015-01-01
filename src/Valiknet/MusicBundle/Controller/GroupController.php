<?php
namespace Valiknet\MusicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GroupController extends Controller
{
    /**
     * This method render list of groups
     *
     * @param Response $request
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
     * @param $slug
     * @return array
     *
     * @Template()
     */
    public function viewAction($slug)
    {
        $group = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ValiknetMusicBundle:Group')
                    ->findOneBySlug($slug);

        if (!$group) {
            throw new NotFoundHttpException('Такой групи немає в базі');
        }

        return [
            "group" => $group
        ];
    }

    /**
     * This method render list of clips
     *
     * @param $slugGroup
     * @return array
     *
     * @Template()
     */
    public function listClipAction($slugGroup)
    {
        $clips = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ValiknetMusicBundle:Group')
                    ->findOneBySlug($slugGroup);

        if (!$clips) {
            throw new NotFoundHttpException('Тай групи немає в базі');
        }

        return [
            "clips" => $clips
        ];
    }

    /**
     * This method render target clip
     *
     * @param $slugGroup
     * @param $slugClip
     * @return array
     *
     * @Template()
     */
    public function clipAction($slugGroup, $slugClip)
    {
        $group = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ValiknetMusicBundle:Group')
                    ->findOneBySlug($slugGroup);

        if (!$group) {
            throw new NotFoundHttpException('Такой групи немає в базі');
        }

        return [
            "group" => $group
        ];
    }

    /**
     * This method render list of all releases group
     *
     * @param $slug
     * @return array
     *
     * @Template()
     */
    public function listReleaseAction($slug)
    {
        $releases = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('ValiknetMusicBundle:Group')
                        ->findOneBySlug($slug);

        if (!$releases) {
            throw new NotFoundHttpException('Такой групи немає в базі');
        }

        return [
            "releases" => $releases
        ];
    }

    /**
     * This method render target release
     *
     * @param $slugGroup
     * @param $slugRelease
     *
     * @Template()
     */
    public function releaseAction($slugGroup, $slugRelease)
    {
        $release = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('ValiknetMusicBundle:Group')
                        ->findOneBySlug($slugGroup);

        if (!$release) {
            throw new NotFoundHttpException('Такой групи немає в базі');
        }

        return [
            "release" => $release
        ];
    }
}
