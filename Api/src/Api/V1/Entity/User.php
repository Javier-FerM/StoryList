<?php

namespace Api\V1\Entity;

use Api\V1\Api;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "user")]
class User extends Api
{
    #[ORM\Column(name: "username", type: "string", length: 255)]
    public string $username;
    #[ORM\Column(name: "email", type: "string", length: 255, nullable: false)]
    public string $email;
    #[ORM\Column(name: "password", type: "string", length: 255, nullable: false)]
    public string $password;
    #[ORM\Column(name: "deleteOn", type: "date", nullable: true)]
    private ?DateTime $deleteOn = null;
    #[ORM\Column(name: "active", type: "boolean", nullable: false, options: ["default" => 0])]
    private ?bool $active = false;
}