<?php

namespace Api;

use Cavesman\Db;

class ApiBase
{
    //Funciones para buscar en la bbdd

    public function findByOne(array $params): ?object
    {
        $db = Db::getManager();

        return $db->getRepository(self::class)->findOneBy($params);
    }

    public function formRequest(): self
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $entity = new static();

        foreach ($data as $key => $value) {
            if(property_exists($entity, $key))
                $entity->$key = $value;
        }

        return $entity;
    }

}