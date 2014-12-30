<?php

namespace Valiknet\MusicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ValiknetMusicBundle:Default:index.html.twig', array('name' => $name));
    }
}
