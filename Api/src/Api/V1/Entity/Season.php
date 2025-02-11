<?php

namespace Api\V1\Entity;

use Api\V1\Api;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "season")]
class Season extends Api
{
    #[ORM\Column(name: "season", type: "integer")]
    public int $season;

    #[ORM\Column(name: "releaseDate", type: "date")] // Fecha de lanzamiento
    public \DateTime $releaseDate;

    #[ORM\ManyToOne(targetEntity: Serie::class, inversedBy: "seasons")]
    public ?Serie $series;

    #[ORM\OneToMany(targetEntity: Episode::class, mappedBy: "seasons")]
    public ?Episode $episodes;
}