<?php

namespace Api\V1\Controller;

use Api\Interface\ControllerInterface;
use Cavesman\Http\JsonResponse;

class Review implements ControllerInterface
{

    public static function list(): JsonResponse
    {
       return new JsonResponse(['message' => 'lista revew', 'revew'=>[]]);
    }

    public static function get($id): JsonResponse
    {
       return new JsonResponse(['message' => 'revew encontrada', 'revew'=>[]]);
    }

    public static function create(): JsonResponse
    {
        return new JsonResponse(['message' => 'revew creada']);
    }

    public static function update($id): JsonResponse
    {
        return new JsonResponse(['message' => 'revew actualizada']);
    }

    public static function delete($id): JsonResponse
    {
        return new JsonResponse(['message' => 'revew eliminada']);
    }
}