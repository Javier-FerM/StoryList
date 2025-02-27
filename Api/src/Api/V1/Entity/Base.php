<?php

namespace Api\V1\Entity;

use Api\ApiBase;
use Doctrine\ORM\Mapping as ORM;


abstract class Base extends ApiBase
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    public ?int $id = 0;

    #[ORM\Column(name: "deletedOn", type: "date", nullable: true)]
    public ?\DateTime $deletedOn = null;

}