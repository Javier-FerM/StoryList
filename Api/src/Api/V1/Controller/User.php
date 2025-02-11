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

            $users = array_map(fn($user = new \Api\V1\Model\User()) => $user, $list);
            return new JsonResponse(['message' => 'Listado de usuarios', 'users' => $users], 200);

        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }

    }

    public static function get(int $id): JsonResponse
    {
        try {
            $user = \Api\V1\Entity\User::findByOne(['id' => $id, 'deletedOn' => null]);

            if (!$user)
                return new JsonResponse(['message' => 'El usuario no existe'], 404);

        } catch (Exception|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }

        return new JsonResponse(['message' => 'Usuario encontrado', 'user' => $user], 200);
    }

    public static function create(): JsonResponse
    {
        try {
            $db = Db::getManager();

            $entity = \Api\V1\Entity\User::formRequest();

            $db->persist($entity);
            $db->flush();
        } catch (QueryException|ORMException $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }
        return new JsonResponse(['message' => 'Usuario creado', 'usuario' => $entity], 201);
    }

    public static function update(int $id): JsonResponse
    {

        try {
            $db = Db::getManager();

            $requestData = \Api\V1\Entity\User::formRequest();

            $model = new \Api\V1\Model\User();

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

    public static function delete(int $id): JsonResponse
    {
        try {
            $db = Db::getManager();
            $entity = \Api\V1\Entity\User::findByOne(['id' => $id, 'deletedOn' => null]);
            if (!$entity)
                return new JsonResponse(['message' => 'El usuario no existe'], 404);

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