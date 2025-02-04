<?php

namespace Api\V1\Controller;

use Cavesman\Db;
use Cavesman\Http\JsonResponse;
use Api\Interface\ControllerInterface;

class User implements ControllerInterface
{

    public static function list(): JsonResponse
    {
        return new JsonResponse(['message' => 'Listado de usuarios', 'users' => []]);
    }

    public static function get($id): JsonResponse
    {

        return new JsonResponse(['message' =>'Usuario encontrado', 'user' => []]);
    }

    public static function create(): JsonResponse
    {
        return new JsonResponse(['message' =>'Nuevo usuario creado']);
    }

    public static function update($id): JsonResponse
    {
        return new JsonResponse(['message' =>'Usuario actualizado', 'user' => []]);
    }

    public static function delete($id): JsonResponse
    {
        return new JsonResponse(['message' =>'Usuario eliminado']);
    }
}