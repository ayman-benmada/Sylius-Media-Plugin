<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Entity\Media;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="abenmada_media_media_tag")
 */
class MediaTag implements ResourceInterface, TranslatableInterface
{
    use TimestampableEntity;
    use TranslatableTrait {
        TranslatableTrait::__construct as private initializeTranslationsCollection;
        TranslatableTrait::getTranslation as private doGetTranslation;
    }

    /**
     * @ORM\Id
     *
     * @ORM\GeneratedValue
     *
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /** @ORM\Column(name="code", type="string", nullable=false) */
    private string $code;

    /**
     * @ORM\ManyToMany(targetEntity=Media::class, mappedBy="tags")
     *
     * @ORM\JoinTable(name="abenmada_media_media_media_tag")
     */
    private Collection $medias;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->medias = new ArrayCollection();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addConstraint(new UniqueEntity([
            'fields' => 'code',
            'groups' => 'abenmada_media_plugin',
        ]));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getLabel(): ?string
    {
        return $this->getTranslation()->getLabel();
    }

    public function setLabel(?string $label): void
    {
        $this->getTranslation()->setLabel($label);
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    /**
     * @param Collection|Media[] $medias
     */
    public function setMedias(Collection $medias): void
    {
        $this->medias = $medias;
    }

    public function addMedia(Media $media): void
    {
        if ($this->medias->contains($media)) {
            return;
        }

        $this->medias[] = $media;
    }

    public function removeMedia(Media $media): void
    {
        $this->medias->removeElement($media);
    }

    public function getTranslation(?string $locale = null): MediaTagTranslation
    {
        /** @var MediaTagTranslation $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    protected function createTranslation(): TranslationInterface
    {
        return new MediaTagTranslation();
    }
}
