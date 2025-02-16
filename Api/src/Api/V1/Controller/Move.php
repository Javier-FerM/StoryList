<?php

namespace Api\V1\Controller;

use Api\Interface\ControllerInterface;
use Api\V1\Api;
use Cavesman\Db;
use Cavesman\Http\JsonResponse;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\Query\QueryException;

class Move implements ControllerInterface
{

    /**
     * @return JsonResponse
     */
    public static function list(): JsonResponse
    {
        try {
            $db = Db::getManager();

            $query = $db->createQuery(
                "SELECT m 
                FROM \Api\V1\Entity\Move m 
                WHERE m.deletedOn is null");

            $list = $query->getResult();

            if (!$list)
                return new JsonResponse(['message' => 'No se han encontrado peliculas'], 404);

            $moves = array_map(fn(\Api\V1\Entity\Move $move) => $move->model(), $list);
            return new JsonResponse(['message' => 'Listado de peliculas', 'peliculas' => $moves], 200);

        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()]);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     */
    public static function get(int $id): JsonResponse
    {
        try {
            $move = \Api\V1\Entity\Move::findByOne(['id' => $id, 'deletedOn' => null]);

            if (!$move)
                return new JsonResponse(['message' => 'La pelicula no existe'], 404);

        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }

        return new JsonResponse(['message' => 'Pelicula encontrado', 'pelicula' => $move->model()], 200);
    }

    /**
     * @return JsonResponse
     */
    public static function create(): JsonResponse
    {
        try {
            $db = Db::getManager();

            $entity = \Api\V1\Entity\Move::formRequest();

            $model = $entity->model();
            $entity = $model->Entity();

            $db->persist($entity);
            $db->flush();
        } catch (\Exception|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }
        return new JsonResponse(['message' => 'Pelicula creada', 'pelicula' => $entity], 201);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public static function update(int $id): JsonResponse
    {
        $entity = \Api\V1\Entity\Move::formRequest();

        $model = $entity->model();

        if ($model->id !== $id)
            return new JsonResponse('Error id', 404);

        try {
            $db = Db::getManager();
            $entity = $model->Entity(true);

            $db->persist($entity);
            $db->flush();
        } catch (\Exception|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }
        return new JsonResponse(['message' => 'Pelicula actualizada', 'pelicula' => $model], 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public static function delete(int $id): JsonResponse
    {
        $entity = \Api\V1\Entity\Move::findByOne(['id' => $id, 'deletedOn' => null]);

        if (!$entity)
            return new JsonResponse(['message' => 'La pelicula no existe'], 404);

        try {
            $db = Db::getManager();

            /**@var \Api\V1\Entity\Serie $entity */
            $entity->deletedOn = new \DateTime();

            $db->persist($entity);
            $db->flush();

        } catch (\Exception|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
        return new JsonResponse(['message' => 'Pelicula eliminado'], 200);
    }

}