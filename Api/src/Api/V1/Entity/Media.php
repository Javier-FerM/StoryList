<?php


namespace Api\V1\Entity;

use Api\V1\Api;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "media")]
class Media extends Api
{
    #[ORM\Column(name: "title", type: "string", length: 255)]
    public string $title;
    #[ORM\Column(name: "description", type: "string", length: 255)]
    public string $description;
    #[ORM\Column(name: "raiting", type: "float")]
    public float $raiting;

    #[ORM\ManyToMany(targetEntity: Genere::class, inversedBy: "media")]
    #[ORM\JoinTable(name: "media_genre")]
    public Collection $generes;
}