<?php

namespace Api\V1\Models;

use Api\V1\Api;

class Move extends Api
{
    public bool $sequel;

    public function Entity(bool $update = false): \Api\V1\Entity\Move
    {
        if ($this->id) {
            $entity = \Api\V1\Entity\Move::findByOne(['id' => $this->id, 'deletedOn' => null]);

            if (!$entity)
                throw new \Exception('La pelicula no existe');

            if (!$update)
                return $entity;
        } else {
            $entity = new \Api\V1\Entity\Move();
        }

        $entity->sequel = $this->sequel;

        return $entity;
    }
}