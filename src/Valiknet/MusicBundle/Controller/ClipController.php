<?php
namespace Valiknet\MusicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClipController extends Controller
{
    /**
     * @description This method render clip by group id and slug
     *
     * @param $slugClip
     * @param $groupId
     * @return array
     * @throws NotFoundHttpException
     *
     * @Template()
     */
    public function showAction($slugClip, $groupId)
    {
        $clip = $this->getDoctrine()
            ->getManager()
            ->getRepository('ValiknetMusicBundle:Clip')
            ->findOneBy(["slug" => $slugClip, "group_id" => $groupId]);

        if (!$clip) {
            throw new NotFoundHttpException('Такого кліпу немає в цій базі');
        }

        return [
            "clip" => $clip
        ];
    }
}
