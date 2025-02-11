<?php

namespace Api\V1\Controller;

use Api\Interface\ControllerInterface;
use Cavesman\Db;
use Cavesman\Http\JsonResponse;
use Doctrine\ORM\Exception\ORMException;

class Media implements ControllerInterface
{

    public static function list(): JsonResponse
    {
        try {
            $db = Db::getManager();

            $query = $db->createQuery(
                "SELECT m 
                FROM \Api\V1\Entity\Media m 
                WHERE m.deletedOn is null");

            $list = $query->getResult();

            if (!$list)
                return new JsonResponse(['message' => 'No se han encontrado Medias'], 404);

            $medias = array_map(fn($media = new \Api\V1\Model\Media()) => $media, $list);
            return new JsonResponse(['message' => 'Listado de medias', 'medias' => $medias], 200);

        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()]);
        }

    }

    public static function get($id): JsonResponse
    {
        try {
            $entity = \Api\V1\Entity\Media::findByOne(['id' => $id, 'deletedOn' => null]);

            if (!$entity)
                return new JsonResponse(['message' => 'No se ha encontrado Media'], 404);

            return new JsonResponse(['message' => 'Media encontrada', 'media' => $entity], 200);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()]);
        }
    }

    public static function create(): JsonResponse
    {
        try {
            $db = Db::getManager();
            $entity = \Api\V1\Entity\Media::formRequest();

            $db->persist($entity);
            $db->flush();
        } catch (\Exception|ORMException $e) {
            return new JsonResponse(['message' => $e->getMessage()]);
        }
        return new JsonResponse(['message' => 'Nuevo media creado', 'media' => $entity], 200);
    }

    public static function update($id): JsonResponse
    {
        try {
            $db = Db::getManager();
            $request = \Api\V1\Entity\Media::formRequest();

            try {
                $model = new \Api\V1\Model\Media()->Entity($request, true);
                $db->persist($model);
                $db->flush();
            } catch (\Exception|ORMException $e) {
                return new JsonResponse(['message' => $e->getMessage()], 500);
            }

        } catch (\Exception|ORMException $e) {
            return new JsonResponse(['message' => $e->getMessage()], 500);
        }
        return new JsonResponse(['message' => 'Media actualizada', 'media' => $model], 200);
    }

    public static function delete($id): JsonResponse
    {
        try {
            $db = Db::getManager();
            $entity = \Api\V1\Entity\Media::findByOne(['id' => $id, 'deletedOn' => null]);
            if (!$entity)
                return new JsonResponse(['message' => 'Media no existe'], 404);

            /**@var \Api\V1\Entity\Media $entity */
            $entity->deletedOn = new \DateTime();
            $db->persist($entity);
            $db->flush();

        } catch (\Exception|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
        return new JsonResponse(['message' => 'Media eliminado'], 200);
    }

    // MOVE
    public static function listMove(int $mediaId): JsonResponse
    {
        $entity = \Api\V1\Entity\Media::findByOne(['id' => $mediaId, 'deletedOn' => null]);
        if (!$entity)
            return new JsonResponse(['message' => 'Media no existe'], 404);

        try {
            $db = Db::getManager();

            $query = $db->createQuery(
                'SELECT u 
                FROM \Api\V1\Entity\Move u
                WHERE u.deletedOn is null'
            );

            $list = $query->getResult();

            if (!$list)
                return new JsonResponse(['message' => 'No se han encontrado peliculas'], 404);

            $moves = array_map(fn($move = new \Api\V1\Model\Move()) => $move, $list);
            return new JsonResponse(['message' => 'Listado de peliculas', 'peliculas' => $moves], 200);

        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }
    }

    public static function getMove(int $mediaId): JsonResponse
    {

    }

    public static function updateMove(): JsonResponse
    {

    }

    public static function createMove(): JsonResponse
    {

    }

    public static function deleteMove(): JsonResponse
    {

    }
}