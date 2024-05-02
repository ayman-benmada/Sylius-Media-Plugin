<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Model\Channel;

use Abenmada\MediaPlugin\Entity\Media\Media;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

trait ChannelTrait
{
    /**
     * @ORM\ManyToMany(targetEntity=Media::class, mappedBy="mediaTags")
     *
     * @ORM\JoinTable(name="abenmada_media_media_channel")
     */
    private Collection $medias;

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
}
