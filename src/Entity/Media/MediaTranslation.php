<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Entity\Media;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Sylius\Component\Resource\Model\AbstractTranslation;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="abenmada_media_media_translation")
 */
class MediaTranslation extends AbstractTranslation implements ResourceInterface
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     *
     * @ORM\GeneratedValue
     *
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /** @ORM\Column(name="description", type="text", nullable=true) */
    private ?string $description = null;

    /** @ORM\Column(name="alt", type="string", length=255, nullable=true) */
    private ?string $alt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): void
    {
        $this->alt = $alt;
    }
}
