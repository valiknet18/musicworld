<?php
namespace Valiknet\MusicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReleaseController extends Controller
{
    /**
     * This method render all release by slug and group id
     *
     * @param $slugRelease
     * @param $groupId
     * @return array
     *
     * @Template()
     */
    public function showAction($slugRelease, $groupId)
    {
        $clip = $this->getDoctrine()
            ->getManager()
            ->getRepository('ValiknetMusicBundle:Clip')
            ->findOneBy(["slug" => $slugRelease, "group_id" => $groupId]);

        if (!$clip) {
            throw new NotFoundHttpException('Такого релізу немає в цієй базі');
        }

        return [
            "clip" => $clip
        ];
    }
}
