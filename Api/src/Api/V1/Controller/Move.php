<?php

namespace Api\V1\Controller;

use Api\Interface\ControllerInterface;
use Cavesman\Http\JsonResponse;

class  Move implements ControllerInterface
{

    public static function list(): JsonResponse
    {
        return new JsonResponse(['message' => 'Lista de peliculas', 'peliculas' => []]);
    }

    public static function get($id): JsonResponse
    {
        return new JsonResponse(['message' =>'Pelicula encontrado', 'pelicula' => []]);
    }

    public static function create(): JsonResponse
    {
        return new JsonResponse(['message' =>'Nuevo pelicula creada']);
    }

    public static function update($id): JsonResponse
    {
        return new JsonResponse(['message' =>'Pelicula actualizada', 'pelicula' => []]);
    }

    public static function delete($id): JsonResponse
    {
        return new JsonResponse(['message' =>'Pelicula eliminada']);
    }
}