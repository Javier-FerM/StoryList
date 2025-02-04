<?php

namespace Api\V1;

use Api\ApiBase;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
class Api extends ApiBase
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    public ?int $id = 0;

}