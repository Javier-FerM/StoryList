<?php

namespace Api\V1\Model;

use Api\V1\Api;
use Doctrine\Common\Collections\Collection;


class Serie extends Api
{
    // public array|Season $seasons = [];
    public Collection $seasons;

    public function Entity(bool $update = false): \Api\V1\Entity\Serie
    {
        if ($this->id) {
            $entity = \Api\V1\Entity\Serie::findByOne(['id' => $this->id, 'deletedOn' => null]);

            if (!$entity)
                throw new \Exception('La pelicula no existe');

            if (!$update)
                return $entity;
        } else {
            $entity = new \Api\V1\Entity\Serie();
        }

        $entity->seasons = $this->seasons;

        return $entity;
    }
}