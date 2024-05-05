<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Entity\Media;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Sylius\Component\Core\Model\Channel;
use Sylius\Component\Core\Model\ImageAwareInterface;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="abenmada_media_media")
 */
#[ORM\Table(name: 'abenmada_media_media')]
#[ORM\Entity]
class Media implements ResourceInterface, TranslatableInterface, ImageAwareInterface
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
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /** @ORM\Column(name="code", type="string", length=255, nullable=false) */
    #[ORM\Column(name: 'code', type: 'string', length: 255, nullable: false)]
    private string $code;

    /** @ORM\OneToOne(targetEntity=MediaFile::class, mappedBy="owner", orphanRemoval=true, cascade={"all"}) */
    #[ORM\OneToOne(targetEntity: MediaFile::class, mappedBy: 'owner', orphanRemoval: true, cascade: ['all'])]
    private ImageInterface $file;

    /** @ORM\Column(name="type", type="string", length=255) */
    #[ORM\Column(name: 'type', type: 'string', length: 255)]
    private string $type;

    /**
     * @ORM\ManyToMany(targetEntity=MediaTag::class, inversedBy="medias")
     *
     * @ORM\JoinTable(name="abenmada_media_media_media_tag")
     */
    #[ORM\JoinTable(name: 'abenmada_media_media_media_tag')]
    #[ORM\ManyToMany(targetEntity: MediaTag::class, inversedBy: 'medias')]
    private Collection $tags;

    /**
     * @ORM\ManyToMany(targetEntity=Channel::class, inversedBy="medias")
     *
     * @ORM\JoinTable(name="abenmada_media_media_channel")
     */
    #[ORM\JoinTable(name: 'abenmada_media_media_channel')]
    #[ORM\ManyToMany(targetEntity: Channel::class, inversedBy: 'medias')]
    private Collection $channels;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->tags = new ArrayCollection();
        $this->channels = new ArrayCollection();
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

    public function getImage(): ImageInterface
    {
        return $this->file;
    }

    public function setImage(?ImageInterface $image): void
    {
        $image?->setOwner($this);

        if ($image === null) {
            return;
        }

        $this->file = $image;
    }

    public function getFile(): ImageInterface
    {
        return $this->getImage();
    }

    public function setFile(ImageInterface $file): void
    {
        $this->setImage($file);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getDescription(): ?string
    {
        return $this->getTranslation()->getDescription();
    }

    public function setDescription(?string $description): void
    {
        $this->getTranslation()->setDescription($description);
    }

    public function getAlt(): ?string
    {
        return $this->getTranslation()->getAlt();
    }

    public function setAlt(?string $alt): void
    {
        $this->getTranslation()->setAlt($alt);
    }

    /**
     * @return Collection|MediaTag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param Collection|MediaTag[] $tags
     */
    public function setTags(Collection $tags): void
    {
        $this->tags = $tags;
    }

    public function addTag(MediaTag $tag): void
    {
        if ($this->tags->contains($tag)) {
            return;
        }

        $this->tags[] = $tag;
    }

    public function removeTag(MediaTag $tag): void
    {
        $this->tags->removeElement($tag);
    }

    /**
     * @return Collection|Channel[]
     */
    public function getChannels(): Collection
    {
        return $this->channels;
    }

    /**
     * @param Collection|Channel[] $channels
     */
    public function setChannels(Collection $channels): void
    {
        $this->channels = $channels;
    }

    public function addChannel(Channel $channel): void
    {
        if ($this->channels->contains($channel)) {
            return;
        }

        $this->channels[] = $channel;
    }

    public function removeChannel(Channel $channel): void
    {
        $this->channels->removeElement($channel);
    }

    public function getTranslation(?string $locale = null): MediaTranslation
    {
        /** @var MediaTranslation $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    protected function createTranslation(): TranslationInterface
    {
        return new MediaTranslation();
    }
}
