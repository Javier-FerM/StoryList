<?php


namespace Api\V1\Entity;

use Api\V1\Api;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "review")]
class Review extends Api
{
    #[ORM\Column(name: "comment", type: "string", length: 255)]
    public string $comment;

    #[ORM\OneToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    private User $user;
}