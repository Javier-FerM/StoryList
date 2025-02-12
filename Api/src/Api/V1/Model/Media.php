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
}