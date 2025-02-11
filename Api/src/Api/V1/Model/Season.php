<?php

namespace Api\V1\Models;

use Api\V1\Api;

class Season extends Api
{
    public int $season = 0;
    public \DateTime $releaseDate;

    public function Entity(bool $update = false): \Api\V1\Entity\Season
    {
        if ($this->id) {
            $entity = \Api\V1\Entity\Season::findByOne(['id' => $this->id, 'deletedOn' => null]);

            if (!$entity)
                throw new \Exception('La temporada no existe');

            if (!$update)
                return $entity;
        } else {
            $entity = new \Api\V1\Entity\Season();
        }

        $entity->season = $this->season;
        $entity->releaseDate = $this->releaseDate;

        return $entity;
    }
}