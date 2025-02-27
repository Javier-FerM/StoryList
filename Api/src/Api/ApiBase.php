<?php

namespace Api;

use Cavesman\Db;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
            $Properties = get_object_vars($this);

            foreach ($Properties as $property => $value) {
                if (property_exists($model, $property)) {
                    if($value instanceof Collection){
                        $model->$property = array_map(fn($item) => method_exists($item, 'model') ? $item->model() : $item, $value->toArray());
                    }else{
                        $model->$property = $value;
                    }
                }
            }
            return $model;
        }
        throw new \Exception("La clase del modelo {$model} no existe.");
    }


}