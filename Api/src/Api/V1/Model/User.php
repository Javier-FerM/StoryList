<?php

namespace Api\V1\Models;


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
    public function Entity( object $data, bool $update = false,): \Api\V1\Entity\User
    {
        if ($data->id) {
            $entity = \Api\V1\Entity\User::findByOne(['id' => $data->id, 'deletedOn' => null]);

            if (!$entity)
                throw new \Exception("El usuario no existe");

            if (!$update)
                return $entity;
        } else {
            $entity = new \Api\V1\Entity\User();
        }

        $entity->username = $data->username;
        $entity->email = $data->email;
        $entity->password = $data->password;

        return $entity;

    }
}