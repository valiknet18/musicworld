<?php
namespace Valiknet\MusicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Valiknet\MusicBundle\Entity\Style;

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
     * @param  Style $style
     * @return array
     *
     * @Template()
     */
    public function showChildrenAction(Style $style)
    {
        return [
            "style" => $style
        ];
    }

    /**
     * This method render groups target style
     *
     * @param  Style $style
     * @return array
     *
     * @Template()
     */
    public function showGroupAction(Style $style)
    {
        return [
            "style" => $style
        ];
    }
}
