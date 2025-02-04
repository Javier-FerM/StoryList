<?php

namespace Api\Interface;

use Cavesman\Http\JsonResponse;

interface ControllerInterface
{
    public static function list():JsonResponse;
    public static function get($id):JsonResponse;
    public static function create():JsonResponse;
    public static function update($id):JsonResponse;
    public static function delete($id):JsonResponse;
}