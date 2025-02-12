<?php

namespace Api\V1\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'series')]
class Serie extends Media
{

    #[ORM\OneToMany(targetEntity: Season::class, mappedBy: "serie", cascade: ["persist", "remove"])]
    public Collection $seasons;

    public function __construct()
    {
        parent::__construct();
        $this->seasons = new ArrayCollection();
    }
}