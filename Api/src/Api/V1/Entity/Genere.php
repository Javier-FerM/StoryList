<?php

namespace Api\V1\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "genere")]
class Genere extends Base
{
    #[ORM\Column(name: "genere", type: "string", length: 255)]
    public string $genere;

    #[ORM\ManyToMany(targetEntity: Media::class, inversedBy: "generes")]
    #[ORM\JoinTable(name: "media_generes")]
    private Collection $media;

    public function __construct()
    {
        $this->media = new ArrayCollection();
    }

}