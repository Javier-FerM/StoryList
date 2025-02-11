<?php

namespace Api\V1\Model;

use Api\V1\Api;

class Serie extends Api
{
/*    public \Api\V1\Entity\Media $media;
    public \Api\V1\Entity\Season $seasons;

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

        $entity->media = $this->media;
        $entity->seasons = $this->seasons;

        return $entity;
    }*/
}