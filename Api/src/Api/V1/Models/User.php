<?php

namespace Api\V1\Models;


use Api\V1\Api;
use Cavesman\Db;

class User extends Api
{
    private string $username = '';

    private string $email = '';

    private string $password = '';


    /**
     * @throws \Exception
     */
    public function Entity(bool $update = false): \Api\V1\Entity\User
    {
       // $db = Db::getManager();

        if ($this->id) {
            $entity = $this->findByOne(['id' => $this->id, 'deletedOn' => null]);

            if (!$entity)
                throw new \Exception("El usuario no existe");
        }

        if (!$update)
            return $entity;

        $entity = \Api\V1\Entity\User::formRequest();

        $entity->username = $this->username;
        $entity->email = $this->email;
        $entity->password = $this->password;

        return $entity;
    }
}