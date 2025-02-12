<?php

namespace Api\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'moves')]
class Move extends Media
{
    #[ORM\Column(name: 'sequel', type: 'boolean', nullable: true)]
    public ?bool $sequel = null;
    #[ORM\Column(name: 'duration', type: 'integer', nullable: false)]
    public int $duration;
}
