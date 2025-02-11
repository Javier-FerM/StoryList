<?php

namespace Api\V1\Model;

use Api\V1\Api;
use Doctrine\Common\Collections\Collection;

class Media extends Api
{
    public string $title = '';
    public string $description = '';
    public float $rating = 0.0;

    /**
     * @param object $data
     * @param bool $update
     * @return \Api\V1\Entity\Media
     * @throws \Exception
     */
    public function Entity(object $data, bool $update = false): \Api\V1\Entity\Media
    {
        if ($data->id) {
            $entity = \Api\V1\Entity\Media::findByOne(['id' => $data->id, 'deletedOn' => null]);

            if (!$entity)
                throw new \Exception('Media no existe');

            if (!$update)
                return $entity;
        } else {
            $entity = new \Api\V1\Entity\Media();
        }

        $entity->title = $data->title;
        $entity->description = $data->description;
        $entity->rating = $data->rating;

        return $entity;
    }
}