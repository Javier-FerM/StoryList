<?php

namespace Api\V1\Controller;

use Api\Interface\ControllerInterface;
use Cavesman\Http\JsonResponse;

class Serie implements ControllerInterface
{

    public static function list(): JsonResponse
    {
        return new JsonResponse(['message' => 'Listado de Series', 'serie' => []]);

    }

    public static function get($id): JsonResponse
    {
        return new JsonResponse(['message' =>'Serie encontrada', 'serie' => []]);
    }

    public static function create(): JsonResponse
    {
        return new JsonResponse(['message' =>'Nueva serie creada']);
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