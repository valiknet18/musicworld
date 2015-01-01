<?php
namespace Valiknet\MusicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Valiknet\MusicBundle\Entity\Release;

class ReleaseController extends Controller
{
    /**
     * This method render all release by slug and group id
     *
     * @param Release $release
     * @return array
     *
     * @Template()
     */
    public function showAction(Release $release)
    {
        return [
            "release" => $release
        ];
    }
}
