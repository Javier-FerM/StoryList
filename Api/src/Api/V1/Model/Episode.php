<?php

namespace Api\V1\Models;

use Api\V1\Api;
use Api\V1\Entity\Season;

class Episode extends Api
{
    public int $episode = 0;
    public string $title = '';
    public \DateTime $duration;
    public Season $season;

    /**
     * @param bool $update
     * @return \Api\V1\Entity\Episode
     * @throws \Exception
     */
    public function Entity(bool $update = false): \Api\V1\Entity\Episode
    {
        if ($this->id) {
            $entity = \Api\V1\Entity\Episode::findByOne(['id' => $this->id, 'deletedOn' => null]);

            if (!$entity)
                throw new \Exception("El episodio no existe");

            if (!$update)
                return $entity;
        } else {
            $entity = new \Api\V1\Entity\Episode();
        }
        $entity->episode = $this->episode;
        $entity->title = $this->title;
        $entity->duration = $this->duration;
        $entity->season = $this->season;

        return $entity;

    }
}