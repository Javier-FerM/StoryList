<?php

namespace Api\V1\Controller;

use Api\Interface\ControllerInterface;
use Cavesman\Db;
use Cavesman\Http\JsonResponse;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\Query\QueryException;

class Move implements ControllerInterface
{

    public static function list(): JsonResponse
    {
        try {
            $db = Db::getManager();

            $query = $db->createQuery(
                "SELECT m 
                FROM \Api\V1\Entity\Move m 
                WHERE m.deletedOn is null");

            $list = $query->getResult();

            if (!$list) {
                $moves = new \Api\V1\Entity\Move();
                return new JsonResponse(['message' => 'No se han encontrado peliculas', 'Moves' => $moves], 404);
            }
            $moves = array_map(fn($move = new \Api\V1\Model\Move()) => $move, $list);
            return new JsonResponse(['message' => 'Listado de peliculas', 'peliculas' => $moves], 200);

        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()]);
        }
    }

    public static function get($id): JsonResponse
    {
        try {
            $move = \Api\V1\Entity\Move::findByOne(['id' => $id, 'deletedOn' => null]);

            if (!$move)
                return new JsonResponse(['message' => 'La pelicula no existe'], 404);

        } catch (Exception|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }

        return new JsonResponse(['message' => 'Pelicula encontrado', 'pelicula' => $move], 200);
    }

    public static function create(): JsonResponse
    {
        try {
            $db = Db::getManager();

            $entity = \Api\V1\Entity\Move::formRequest();

            $db->persist($entity);
            $db->flush();
        } catch (QueryException|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }
        return new JsonResponse(['message' => 'Pelicula creada', 'pelicula' => $entity], 201);
    }

    public static function update($id): JsonResponse
    {
        try {
            $db = Db::getManager();

            $requestData = \Api\V1\Entity\Move::formRequest();

            $model = new \Api\V1\Model\Move();

            try {
                $entity = $model->Entity($requestData, true);

                $db->persist($entity);
                $db->flush();

                return new JsonResponse(['message' => 'Usuario actualizado correctamente.', 'user' => $entity], 200);
            } catch (\Exception|ORMException $e) {

                return new JsonResponse(['error' => $e->getMessage()], 404);
            }
        } catch (QueryException|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    public static function delete($id): JsonResponse
    {
        try {
            $db = Db::getManager();
            $entity = \Api\V1\Entity\Move::findByOne(['id' => $id, 'deletedOn' => null]);
            if (!$entity)
                return new JsonResponse(['message' => 'La pelicula no existe'], 404);

            /**@var \Api\V1\Entity\Move $entity */
            $entity->deletedOn = new \DateTime();
            $db->persist($entity);
            $db->flush();

        } catch (\Exception|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
        return new JsonResponse(['message' => 'Pelicula eliminado'], 200);
    }

}