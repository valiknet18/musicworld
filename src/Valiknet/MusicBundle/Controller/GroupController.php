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
     * @param  Response $request
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

        $clip = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ValiknetMusicBundle:Clip')
                    ->findOneBy(['slug' => $slugClip, 'group' => $group->getId()]);

        if (!$clip) {
            throw new NotFoundHttpException('В цієї групи такого кліпу немає');
        }

        return [
            "group" => $group,
            "clip" => $clip
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
    public function listReleaseAction($slugGroup)
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
     * This method render target release
     *
     * @param $slugGroup
     * @param $slugRelease
     *
     * @Template()
     */
    public function releaseAction($slugGroup, $slugRelease)
    {
        $group = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('ValiknetMusicBundle:Group')
                        ->findOneBySlug($slugGroup);

        if (!$group) {
            throw new NotFoundHttpException('Такої групи немає в базі');
        }

        $release = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('ValiknetMusicBundle:Release')
                        ->findOneBy(['slug' => $slugRelease, 'group' => $group]);

        if (!$release) {
            throw new NotFoundHttpException('Такого релізу в цієї групи немає');
        }

        return [
            "group" => $group,
            "release" => $release
        ];
    }

    /**
     * This method render players list
     *
     * @param $slug
     * @return array
     *
     * @Template()
     */
    public function playersAction($slug)
    {
        $group = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ValiknetMusicBundle:Group')
                    ->findOneBySlug($slug);

        if (!$group) {
            throw new NotFoundHttpException('Такої групи немає в базі');
        }

        return [
            'group' => $group
        ];
    }

    /**
     * This method render contact page
     *
     * @param $slug
     * @return array
     *
     * @Template()
     */
    public function contactsAction($slug)
    {
        $group = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ValiknetMusicBundle:Group')
                    ->findOneBySlug($slug);

        if (!$group) {
            throw new NotFoundHttpException('Такої групи немає в базі');
        }

        return [
            "group" => $group
        ];
    }

    /**
     * This method render list news
     *
     * @param $slug
     * @return array
     *
     * @Template()
     */
    public function listNewsAction($slug)
    {
        $group = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ValiknetMusicBundle:Group')
                    ->findOneBySlug($slug);

        if (!$group) {
            throw new NotFoundHttpException('Такої групи немає в базі');
        }

        return [
            "group" => $group
        ];
    }
}
