<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Entity\Media;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Sylius\Component\Core\Model\Image;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="abenmada_media_media_file")
 */
class MediaFile extends Image
{
    use TimestampableEntity;

    /**
     * @ORM\OneToOne(targetEntity=Media::class, inversedBy="file")
     *
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", nullable=false, onDelete="cascade")
     *
     * @var object|null
     */
    protected $owner;
}
