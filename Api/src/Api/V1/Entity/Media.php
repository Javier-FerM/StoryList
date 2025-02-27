<?php


namespace Api\V1\Entity;

use Api\ApiBase;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "media")]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(['move' => 'Api\V1\Entity\Move', 'series' => 'Api\V1\Entity\Serie'])]
abstract class Media extends ApiBase
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    public ?int $id = 0;
    #[ORM\Column(name: "deletedOn", type: "date", nullable: true)]
    public ?\DateTime $deletedOn = null;
    #[ORM\Column(name: "title", type: "string", length: 255, unique: true)]
    public string $title;
    #[ORM\Column(name: "description", type: "text", length: 65535)]
    public $description;
    #[ORM\Column(name: "raiting", type: "float")]
    public float $rating;

    #[ORM\ManyToMany(targetEntity: Genere::class, mappedBy: "media")]
    public Collection $generes;

    public function __construct()
    {
        $this->generes = new ArrayCollection();
    }
    
}