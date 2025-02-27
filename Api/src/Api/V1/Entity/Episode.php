<?php


namespace Api\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "episode")]
class Episode extends Base
{
    #[ORM\Column(name: "episode", type: "integer")]
    public int $episode;

    #[ORM\Column(name: "title", type: "string", length: 255)]
    public string $title;

    #[ORM\Column(name: "duration", type: "time")]
    public \DateTime $duration;

    #[ORM\ManyToOne(targetEntity: Season::class, inversedBy: "episodes")]
    #[ORM\JoinColumn(name: "season_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private ?Season $season = null;

}
