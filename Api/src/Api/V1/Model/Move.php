<?php

namespace Api\V1\Model;

use Api\V1\Api;

class Move extends Media
{
    public bool $sequel;
    public int $duration;
    public Media $media;

    /**
     * @param object $data
     * @param bool $update
     * @return \Api\V1\Entity\Move
     * @throws \Exception
     */
    public function Entity(bool $update = false): \Api\V1\Entity\Move
    {
        if ($this->id) {
            $entity = \Api\V1\Entity\Move::findByOne(['id' => $this->id, 'deletedOn' => null]);

            if (!$entity)
                throw new \Exception("La pelicula no existe");

            if (!$update)
                return $entity;
        } else {
            $entity = new \Api\V1\Entity\Move();
        }

       foreach ($this as $key => $value) {
           if(property_exists($entity, $key))
               $entity->$key = $value;
       }

        return $entity;

    }
}