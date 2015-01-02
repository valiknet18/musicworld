<?php
namespace Valiknet\MusicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StyleController extends Controller
{
    /**
     * This method render list main styles
     *
     * @return array
     *
     * @Template()
     */
    public function listAction()
    {
        $styles = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ValiknetMusicBundle:Style')
                    ->findStyleWithoutParent();

        return [
            "styles" => $styles
        ];
    }

    /**
     * This method return
     *
     * @param $slug
     * @return array
     *
     * @Template()
     */
    public function showChildrenAction($slug)
    {
        $style = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ValiknetMusicBundle:Style')
                    ->findOneBy(["slug" => $slug]);

        if (!$style) {
            throw new NotFoundHttpException('Такого жанру немає в базі');
        }

        return [
            "style" => $style
        ];
    }

    /**
     * This method render groups target style
     *
     * @param $slug
     * @return array
     *
     * @Template()
     */
    public function showGroupAction($slug)
    {
        $style = $this->getDoctrine()
            ->getManager()
            ->getRepository('ValiknetMusicBundle:Style')
            ->findOneBy(["slug" => $slug]);

        if (!$style) {
            throw new NotFoundHttpException('Такого жанру немає в базі');
        }

        return [
            "style" => $style
        ];
    }
}
