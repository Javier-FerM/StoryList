<?php

namespace Api\V1\Controller;

use Cavesman\Db;
use Cavesman\Http\JsonResponse;
use Api\Interface\ControllerInterface;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\Query\QueryException;

class User implements ControllerInterface
{

    /**
     * @return JsonResponse
     */
    public static function list(): JsonResponse
    {
        try {
            $db = Db::getManager();

            $query = $db->createQuery(
                'SELECT u 
                FROM \Api\V1\Entity\User u
                WHERE u.deletedOn is null'
            );

            $list = $query->getResult();

            if (!$list)
                return new JsonResponse(['message' => 'No se han encontrado usuarios'], 404);

            $users = array_map(fn(\Api\V1\Entity\User $user) => $user->model(), $list);
            return new JsonResponse(['message' => 'Listado de usuarios', 'users' => $users], 200);

        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }

    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public static function get(int $id): JsonResponse
    {
        try {
            $user = \Api\V1\Entity\User::findByOne(['id' => $id, 'deletedOn' => null]);

            if (!$user)
                return new JsonResponse(['message' => 'El usuario no existe'], 404);

        } catch (Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }

        return new JsonResponse(['message' => 'Usuario encontrado', 'user' => $user->model()], 200);
    }

    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public static function create(): JsonResponse
    {
        try {
            $db = Db::getManager();

            $entity = \Api\V1\Entity\User::formRequest();

            $model = $entity->model();
            $entity = $model->Entity();

            $db->persist($entity);
            $db->flush();
        } catch (\Exception|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }
        return new JsonResponse(['message' => 'Usuario creado', 'usuario' => $entity->model()], 201);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public static function update(int $id): JsonResponse
    {
        $entity = \Api\V1\Entity\User::formRequest();

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
        return new JsonResponse(['message' => 'Usuario actualizada', 'usuario' => $model], 200);

    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public static function delete(int $id): JsonResponse
    {
        $entity = \Api\V1\Entity\User::findByOne(['id' => $id, 'deletedOn' => null]);

        if (!$entity)
            return new JsonResponse(['message' => 'El usuario no existe'], 404);

        try {
            $db = Db::getManager();

            /**@var \Api\V1\Entity\User $entity */
            $entity->deletedOn = new \DateTime();

            $db->persist($entity);
            $db->flush();

        } catch (\Exception|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
        return new JsonResponse(['message' => 'Usuario eliminado'], 200);
    }
}