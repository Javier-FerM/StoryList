<?php

namespace Api\V1\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Api\V1\Api;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "genere")]
class Genere extends Api
{
    #[ORM\Column(name: "name", type: "string", length: 255)]
    public string $name;

    #[ORM\ManyToMany(targetEntity: Media::class, inversedBy: "generes")]
    #[ORM\JoinTable(name: "media_generes")]
    public Collection $media;

    public function __construct()
    {
        $this->media = new ArrayCollection();
    }
}