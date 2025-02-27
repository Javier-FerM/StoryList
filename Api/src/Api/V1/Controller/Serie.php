<?php

namespace Api\V1\Controller;

use Api\Interface\ControllerInterface;
use Cavesman\Db;
use Cavesman\Http\JsonResponse;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\Query\QueryException;

class Serie implements ControllerInterface
{

    /**
     * @return JsonResponse
     */
    public static function list(): JsonResponse
    {
        try {
            $db = Db::getManager();

            $list = $db->getRepository(\Api\V1\Entity\Serie::class)->findBy(['deletedOn' => null]);

            if (!$list) {
                $series = new \Api\V1\Model\Serie();
                return new JsonResponse(['message' => 'No se han encontrado series', 'series' => $series], 404);
            }

            $series = array_map(fn(\Api\V1\Entity\Serie $serie) => $serie->model() , $list);

          return new JsonResponse(['message' => 'Listado de series', 'series' => $series], 200);

        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()]);
        }

    }

    /**
     * @throws \Exception
     */
    public static function get(int $id): JsonResponse
    {
        $entity = \Api\V1\Entity\Serie::findByOne(['id' => $id, 'deletedOn' => null]);
        if (!$entity)
            return new JsonResponse('Serie no encontrado', 404);

        return new JsonResponse(['message' => 'Serie encontrada', 'serie' => $entity->model()], 200);
    }

    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public static function create(): JsonResponse
    {
        try {
            $db = Db::getManager();

            $entity = \Api\V1\Entity\Serie::formRequest();

            $db->persist($entity);
            $db->flush();
        } catch (\Exception|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }
        return new JsonResponse(['message' => 'Serie creada', 'Serie' => $entity->model()], 201);
    }

    /**
     * @throws \Exception
     */
    public static function update(int $id): JsonResponse
    {
        $entity = \Api\V1\Entity\Serie::formRequest();

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
        return new JsonResponse(['message' => 'Serie actualizada', 'serie' => $model], 200);
    }

    public static function delete(int $id): JsonResponse
    {
        $entity = \Api\V1\Entity\Serie::findByOne(['id' => $id, 'deletedOn' => null]);

        if (!$entity)
            return new JsonResponse('Serie no encontrado', 404);

        try {
            $db = Db::getManager();

            /**@var \Api\V1\Entity\Serie $entity */
            $entity->deletedOn = new \DateTime();

            $db->persist($entity);
            $db->flush();
        } catch (\Exception|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }

        return new JsonResponse(['message' => 'Serie eliminada']);
    }
}