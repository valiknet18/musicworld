<?php
namespace Valiknet\MusicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Valiknet\MusicBundle\Entity\Article;
use Valiknet\MusicBundle\Form\Type\ArticleType;

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

    /**
     * This method render form for create article
     *
     * @param  Request                                                  $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Template()
     */
    public function createArticleAction(Request $request)
    {
        $em = $this->getDoctrine()
                ->getManager();

        $article = new Article();

        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "form" => $form->createView()
        ];
    }

    /**
     * This method render form update article
     *
     * @param  Article                                                  $article
     * @param  Request                                                  $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Template()
     */
    public function updateArticleAction(Article $article, Request $request)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('valiknet_home');
        }

        return [
            "article" => $article,
            "form" => $form->createView()
        ];
    }
}
