<?php


namespace Api\V1\Entity;

use Api\V1\Api;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "episode")]
class Episode extends Api
{
    #[ORM\Column(name: "episode", type: "integer")]
    public int $episode;

    #[ORM\Column(name: "title", type: "string", length: 255)]
    public string $title;

    #[ORM\Column(name: "duration", type: "time")]
    public \DateTime $duration;

    #[ORM\ManyToOne(targetEntity: Season::class, inversedBy: "episode")]
    public Season $season;
}
