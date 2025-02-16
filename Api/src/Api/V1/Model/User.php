<?php

namespace Api\V1\Model;


use Api\V1\Api;
use Cavesman\Db;

class User extends Api
{
    public string $username = '';

    public string $email = '';

    public string $password = '';


    /**
     * @param bool $update
     * @param object $data
     * @return \Api\V1\Entity\User
     * @throws \Exception
     */
    public function Entity(bool $update = false): \Api\V1\Entity\User
    {
        if ($this->id) {
            $entity = \Api\V1\Entity\User::findByOne(['id' => $this->id, 'deletedOn' => null]);

            if (!$entity)
                throw new \Exception("El usuario no existe");

            if (!$update)
                return $entity;
        } else {
            $entity = new \Api\V1\Entity\User();
        }

        $entity->username = $this->username;
        $entity->email = $this->email;
        $entity->password = $this->password;

        return $entity;

    }
}