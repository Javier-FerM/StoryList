<?php

namespace Api\V1;

use Api\ApiBase;
use Doctrine\ORM\Mapping as ORM;


class Api extends ApiBase
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    public ?int $id = 0;

    #[ORM\Column(name: "deletedOn", type: "datetime", nullable: true)]
    public ?\DateTime $deletedOn = null;

}