<?php

namespace Api\V1\Controller;

use Api\Interface\ControllerInterface;
use Cavesman\Http\JsonResponse;

class Media implements ControllerInterface
{

    public static function list(): JsonResponse
    {
        return new JsonResponse([]);
    }

    public static function get($id): JsonResponse
    {
        return new JsonResponse(['message' =>'Media encontrada', 'media' => []]);
    }

    public static function create(): JsonResponse
    {
        return new JsonResponse(['message' =>'Nuevo media creado']);
    }

    public static function update($id): JsonResponse
    {
        return new JsonResponse(['message' =>'Media actualizada', 'media' => []]);
    }

    public static function delete($id): JsonResponse
    {
        return new JsonResponse(['message' =>'Media eliminada']);
    }
}