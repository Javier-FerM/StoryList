<?php

namespace Api\V1\Entity;

use Api\V1\Api;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'series')]
class Serie extends Api
{
    #[ORM\OneToOne(targetEntity: Media::class)]
    #[ORM\JoinColumn(name: "media_id", referencedColumnName: "id")]
    public Media $media;

    #[ORM\OneToMany(targetEntity: Season::class, mappedBy: "serie")]
    public Collection $seasons;

    public function __construct()
    {
        $this->seasons = new ArrayCollection();
    }
}