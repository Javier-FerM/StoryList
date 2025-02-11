<?php

namespace Api\Interface;

use Cavesman\Http\JsonResponse;

interface ControllerInterface
{
    public static function list():JsonResponse;
    public static function get(int $id):JsonResponse;
    public static function create():JsonResponse;
    public static function update(int $id):JsonResponse;
    public static function delete(int $id):JsonResponse;
}