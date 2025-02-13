<?php

namespace Api\V1\Controller;

use Api\Interface\ControllerInterface;
use Cavesman\Db;
use Cavesman\Http\JsonResponse;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\Query\QueryException;

class Serie implements ControllerInterface
{

    public static function list(): JsonResponse
    {
        try {
            $db = Db::getManager();

            $query = $db->createQuery(
                "SELECT m 
                FROM \Api\V1\Entity\Serie m 
                WHERE m.deletedOn is null");

            $list = $query->getResult();

            if (!$list) {
                $series = new \Api\V1\Entity\Serie();
                return new JsonResponse(['message' => 'No se han encontrado series', 'series' => $series], 404);
            }

            $series = array_map(fn(\Api\V1\Entity\Serie $serie) => $serie, $list);
            return new JsonResponse(['message' => 'Listado de series', 'series' => $series], 200);

        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()]);
        }

    }

    public static function get($id): JsonResponse
    {
        return new JsonResponse(['message' =>'Serie encontrada', 'serie' => []]);
    }

    public static function create(): JsonResponse
    {
        try {
        $db = Db::getManager();

        $entity = \Api\V1\Entity\Serie::formRequest();

        $db->persist($entity);
        $db->flush();
    } catch (QueryException|ORMException $e) {
        return new JsonResponse(['error' => $e->getMessage()]);
    }
        return new JsonResponse(['message' => 'Serie creada', 'Serie' => $entity], 201);
    }

    public static function update($id): JsonResponse
    {
        return new JsonResponse(['message' =>'Serie actualizada', 'serie' => []]);
    }

    public static function delete($id): JsonResponse
    {
        return new JsonResponse(['message' =>'Serie eliminada']);
    }
}