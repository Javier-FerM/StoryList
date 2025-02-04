<?php

namespace Api\V1\Entity;

use Api\V1\Api;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'moves')]
class Move extends Api
{
    #[ORM\Column(name: 'sequel', type: 'boolean', nullable: true)]
    public ?bool $sequel = null;
}
