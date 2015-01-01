<?php
namespace Valiknet\MusicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Valiknet\MusicBundle\Entity\Clip;

class ClipController extends Controller
{
    /**
     * This method render clip by Clip
     *
     * @param Clip $clip
     * @return array
     *
     * @Template()
     */
    public function showAction(Clip $clip)
    {
        return [
            "clip" => $clip
        ];
    }
}
