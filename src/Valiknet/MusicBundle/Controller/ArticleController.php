<?php
namespace Valiknet\MusicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends Controller
{
    /**
     * This method render list of all articles
     *
     * @param Request $request
     * @return array
     *
     * @Template()
     */
    public function listAction(Request $request)
    {
        $articles = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('ValiknetMusicBundle:Article')
                        ->findBy([], ['id' => 'DESC']);

        $paginator  = $this->get('knp_paginator');
        $articles = $paginator->paginate(
            $articles,
            $request->query->get('page', 1),
            10
        );

        return [
            "articles" => $articles
        ];
    }

    /**
     * This method render article by slug
     *
     * @param $slug
     * @return array
     *
     * @Template()
     */
    public function viewAction($slug)
    {
        $article = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('ValiknetMusicBundle:Article')
                        ->findOneBySlug($slug);

        if (!$article) {
            throw new NotFoundHttpException('Такой статі немає в базі');
        }

        return [
            "article" => $article
        ];
    }
}
