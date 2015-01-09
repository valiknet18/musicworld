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

        $articles = $this->get('valiknet.service.extend_paginator')->extend($articles);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($this->get('translator')->trans('articles.articles', [], 'article'), $this->get("router")->generate("valiknet_home"));

        return [
            "articles" => $articles,
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
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($this->get('translator')->trans('articles.articles', [], 'article'), $this->get("router")->generate("valiknet_home"));
        $breadcrumbs->addItem($article->getName(), $this->get('router')->generate("valiknet_article_view", ["slug" => $article->getSlug()]));

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
        $groups = $this->get('valiknet.service.extend_paginator')->extend($article->getGroups());

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($this->get('translator')->trans('articles.articles', [], 'article'), $this->get("router")->generate("valiknet_home"));
        $breadcrumbs->addItem($article->getName(), $this->get('router')->generate("valiknet_article_view", ["slug" => $article->getSlug()]));
        $breadcrumbs->addItem($this->get('translator')->trans('articles.navigator.groups', [], 'article'), $this->get('router')->generate("valiknet_article_group_list", ["slug" => $article->getSlug()]));

        return [
            "article" => $article,
            "groups" => $groups
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
        $users = $this->get('valiknet.service.extend_paginator')->extend($article->getUsers());

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($this->get('translator')->trans('articles.articles', [], 'article'), $this->get("router")->generate("valiknet_home"));
        $breadcrumbs->addItem($article->getName(), $this->get('router')->generate("valiknet_article_view", ["slug" => $article->getSlug()]));
        $breadcrumbs->addItem($this->get('translator')->trans('articles.navigator.users', [], 'article'), $this->get('router')->generate("valiknet_article_user_list", ["slug" => $article->getSlug()]));

        return [
            "article" => $article,
            "users" => $users
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
