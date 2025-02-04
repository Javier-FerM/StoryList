<?php

namespace Api\V1\Entity;

use Api\V1\Api;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Season")]
class Season extends Api
{
    #[ORM\Column(name: "season", type: "integer")]
    public int $season;

    #[ORM\Column(name: "releaseDate", type: "date")] // Fecha de lanzamiento
    public \DateTime $releaseDate;

    #[ORM\ManyToOne(targetEntity: Serie::class, inversedBy: "season")]
    public ?Serie $series;

    #[ORM\OneToMany(targetEntity: Episode::class, mappedBy: "season")]
    public ?Episode $episodes;
}