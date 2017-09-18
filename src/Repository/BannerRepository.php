<?php

namespace Hgabka\KunstmaanBannerBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BannerRepository extends EntityRepository
{
    public function getBannersForPlace($place, $locale)
    {
        return $this
            ->createQueryBuilder('b')
            ->leftJoin('b.media', ' m')
            ->leftJoin('b.hoverMedia', 'hm')
            ->where('b.place = :place')
            ->setParameter('place', $place)
            ->andWhere('b.start IS NULL OR b.start <= :now')
            ->andWhere('b.end IS NULL OR b.end >= :now')
            ->setParameter('now', new \DateTime())
            ->andWhere('b.locale = :locale OR b.locale IS NULL')
            ->setParameter(':locale', $locale)
            ->getQuery()
            ->getResult()
        ;
    }
}
