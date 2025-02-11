<?php

namespace Api\V1\Model;

use Api\V1\Api;

class Genere extends Api
{
    public string $name = '';
    public Media $media;

    /**
     * @param bool $update
     * @return \Api\V1\Entity\Genere
     * @throws \Exception
     */
    public function Entity(bool $update = false): \Api\V1\Entity\Genere
    {
        if ($this->id) {
            $entity = \Api\V1\Entity\Genere::findByOne(['id' => $this->id, 'deletedOn' => null]);

            if (!$entity)
                throw new \Exception('El genero no existe');

            if (!$update)
                return $entity;

        } else {
            $entity = new \Api\V1\Entity\Genere();
        }

        $entity->name = $this->name;
        $this->media = $entity;

        return $entity;

    }
}