<?php

namespace Api\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

use Api\V1\Api;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "Genere")]
class Genere extends Api
{
    #[ORM\Column(name: "name", type: "string", length: 255)]
    private string $name;

    #[ORM\ManyToMany(targetEntity: Media::class, mappedBy: "generes")]
    private Collection $media;
}