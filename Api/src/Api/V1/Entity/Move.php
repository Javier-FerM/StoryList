<?php

namespace Api\V1\Entity;

use Api\V1\Api;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'moves')]
class Move extends Api
{
    #[ORM\Column(name: 'sequel', type: 'boolean', nullable: true)]
    public ?bool $sequel = null;

    #[ORM\OneToOne(targetEntity: Media::class)]
    #[ORM\JoinColumn(name: "media_id", referencedColumnName: "id")]
    public Media $media;


}
