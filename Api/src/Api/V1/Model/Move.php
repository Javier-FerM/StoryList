<?php

namespace Api\V1\Model;

use Api\V1\Api;

class Move extends Api
{
    public bool $sequel;
    public int $duration;

    /**
     * @param object $data
     * @param bool $update
     * @return \Api\V1\Entity\Move
     * @throws \Exception
     */
    public function Entity( object $data, bool $update = false): \Api\V1\Entity\Move
    {
        if ($data->id) {
            $entity = \Api\V1\Entity\Move::findByOne(['id' => $data->id, 'deletedOn' => null]);

            if (!$entity)
                throw new \Exception("La pelicula no existe");

            if (!$update)
                return $entity;
        } else {
            $entity = new \Api\V1\Entity\Move();
        }

        $entity->sequel = $data->sequel;
        $entity->duration = $data->duration;

        return $entity;

    }
}