<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Repository;

use Abenmada\MediaPlugin\Entity\Media\Media;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class MediaRepository extends EntityRepository
{
    /**
     * @param string[]|null $channelCodes
     * @param string[]|null $tagCodes
     * @param string[]|null $types
     *
     * @return Media[]
     */
    public function findAllByChannelCodesAndTagCodesAndTypes(?array $channelCodes = null, ?array $tagCodes = null, ?array $types = null): array
    {
        $qb = $this->createQueryBuilder('e');

        if ($channelCodes !== null) {
            $qb
                ->leftJoin('e.channels', 'channel')
                ->andWhere('channel.code IN (:channelCodes)')
                ->setParameter('channelCodes', $channelCodes);
        }

        if ($tagCodes !== null) {
            $qb
                ->leftJoin('e.tags', 'tag')
                ->andWhere('tag.code IN (:tagCodes)')
                ->setParameter('tagCodes', $tagCodes);
        }

        if ($types !== null) {
            $qb
                ->andWhere('e.type IN (:types)')
                ->setParameter('types', $types);
        }

        return $qb->getQuery()->getResult();
    }
}
