<?php

namespace Valiknet\MusicBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * StyleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StyleRepository extends EntityRepository
{
    public function findStyleWithoutParent()
    {
        $styles = $this->getEntityManager()
                    ->getRepository('ValiknetMusicBundle:Style')
                    ->createQueryBuilder('s')
                    ->where('s.parent is NULL')
                    ->getQuery()
                    ->getResult();

        return $styles;
    }
}
