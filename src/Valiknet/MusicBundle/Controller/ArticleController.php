<?php
namespace Valiknet\MusicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Valiknet\MusicBundle\Entity\Article;

class ArticleController extends Controller
{
    /**
     * This method render list of all articles
     *
     * @param  Request $request
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
     * @param  Article $article
     * @return array
     *
     * @Template()
     */
    public function viewAction(Article $article)
    {
        return [
            "article" => $article
        ];
    }

    /**
     * This method render list groups
     *
     * @param  Article $article
     * @return array
     *
     * @Template()
     */
    public function listGroupAction(Article $article)
    {
        return [
            "article" => $article
        ];
    }

    /**
     * This method render list users
     *
     * @param  Article $article
     * @return array
     *
     * @Template()
     */
    public function listUserAction(Article $article)
    {
        return [
            "article" => $article
        ];
    }
}
