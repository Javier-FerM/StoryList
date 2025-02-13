<?php

namespace Api;

use Cavesman\Db;

use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
class ApiBase
{

    public static function findByOne(array $params): ?object
    {
        $db = Db::getManager();

        return $db->getRepository(static::class)->findOneBy($params);
    }

    public static function formRequest(): self
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $entity = new static();

        foreach ($data as $key => $value) {
            if(property_exists($entity, $key))
                $entity->$key = $value;
        }

        return $entity;
    }

    public function model()
    {
        return get_object_vars($this);
    }

}