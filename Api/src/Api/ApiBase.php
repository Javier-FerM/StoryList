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
            if (property_exists($entity, $key))
                $entity->$key = $value;
        }

        return $entity;
    }

    /**
     * @throws \Exception
     */
    public function model()
    {
        $entity = get_class($this);

        $model = str_replace('\Entity\\', '\Model\\', $entity);
        $model = '\\' . ltrim($model, '\\');

        if (class_exists($model)) {
            $model = new $model();

            $entityProperties = get_object_vars($this);

            foreach ($entityProperties as $property => $value) {
                if (property_exists($model, $property)) {
                    $model->$property = $value;
                }
            }
            return $model;
        } else {
            throw new \Exception("La clase del modelo {$model} no existe.");
        }
    }

}