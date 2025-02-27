<?php

namespace Api\V1\Model;

use Doctrine\Common\Collections\Collection;


class Serie extends Media
{
    public array $seasons = [];

    /**
     * @param bool $update
     * @return \Api\V1\Entity\Serie
     * @throws \Exception
     */
    public function Entity(bool $update = false): \Api\V1\Entity\Serie
    {
        if ($this->id) {
            $entity = \Api\V1\Entity\Serie::findByOne(['id' => $this->id, 'deletedOn' => null]);

            if (!$entity)
                throw new \Exception('La serie no existe',404);

            if (!$update)
                return $entity;
        } else {
            $entity = new \Api\V1\Entity\Serie();
        }

        foreach ($this as $key => $value) {
            if(property_exists($entity, $key))
                $entity->$key = $value;
        }


        return $entity;
    }
}