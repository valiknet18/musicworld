<?php
namespace Valiknet\MusicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Valiknet\MusicBundle\Entity\Track;

class TrackController extends Controller
{
    public function removeAction(Track $track)
    {
        $em = $this->getDoctrine()
                ->getManager();

        $em->remove($track);
        $em->flush();

        return JsonResponse::create([], 200);
    }
}
