<?php

namespace Api\V1\Model;

class Season extends Base
{
    public int $season = 0;
    public \DateTime $releaseDate;
    public array $episodes = [];

    /**
     * @param bool $update
     * @return \Api\V1\Entity\Season
     * @throws \Exception
     */
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