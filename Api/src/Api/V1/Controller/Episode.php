<?php
namespace Api\V1\Controller;

use Api\Interface\ControllerInterface;
use Cavesman\Http\JsonResponse;

class Episode implements ControllerInterface
{

    public static function list(): JsonResponse
    {
       return new JsonResponse(['message' => 'Listado de episodios']);
    }

    public static function get($id): JsonResponse
    {
        return new JsonResponse(['message' => 'episodio encontrado', 'episodio'=>[]], 200);
    }

    public static function create(): JsonResponse
    {
        return new JsonResponse(['message' => 'episodio creado', 'episodio'=>[]], 200);
    }

    public static function update($id): JsonResponse
    {
       return new JsonResponse(['message' => 'episodio actualizado', 'episodio'=>[]], 200);
    }

    public static function delete($id): JsonResponse
    {
        return new JsonResponse(['message' => 'episodio eliminado'], 200);
    }
}