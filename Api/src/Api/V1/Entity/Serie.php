<?php

namespace Api\V1\Entity;

use Api\V1\Api;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'series')]
class Serie extends Api
{
    #[ORM\OneToOne(targetEntity: Media::class)]
    #[ORM\JoinColumn(name: "media_id", referencedColumnName: "id")]
    private Media $media;

    #[ORM\OneToMany(targetEntity: Season::class, mappedBy: "serie")]
    private Season $season;

}