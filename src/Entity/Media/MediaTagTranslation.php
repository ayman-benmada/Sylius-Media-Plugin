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
 * @ORM\Table(name="abenmada_media_media_tag_translation")
 */
class MediaTagTranslation extends AbstractTranslation implements ResourceInterface
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

    /** @ORM\Column(name="label", type="string", length=255, nullable=false) */
    private ?string $label = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }
}
