<?php

namespace Api\V1\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "season")]
class Season extends Base
{
    #[ORM\Column(name: "season", type: "integer")]
    public int $season;

    #[ORM\Column(name: "releaseDate", type: "date", nullable: false)]
    public \DateTime $releaseDate;

    #[ORM\ManyToOne(targetEntity: Serie::class, inversedBy: "seasons")]
    #[ORM\JoinColumn(name: "serie_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private ?Serie $series = null;

    #[ORM\OneToMany(targetEntity: Episode::class, mappedBy: "season", cascade: ["persist", "remove"])]
    public Collection $episodes;

    public function __construct()
    {
       $this->episodes = new ArrayCollection();
    }
}