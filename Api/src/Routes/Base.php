<?php

use Api\V1\Controller\Episode;
use Api\V1\Controller\Media;
use Api\V1\Controller\Move;
use Api\V1\Controller\Review;
use Api\V1\Controller\Serie;
use Api\V1\Controller\User;

use Cavesman\Router;
use Cavesman\Http\JsonResponse;

Router::mount('/api/v1', function () {
    Router::get('/', fn() => new JsonResponse(['message' => 'Bienvenido a la Api de StoryList']));

    Router::mount('/user', function () {
        Router::get("/", [User::class, 'list']);
        Router::get("/{id}", [User::class, 'get']);
        Router::put("/{id}", [User::class, 'update']);
        Router::post("/", [User::class, 'create']);
        Router::delete("/{id}", [User::class, 'delete']);
    });


    Router::mount('/media', function () {
        Router::get("/", [Media::class, 'list']);
        Router::get("/{id}", [Media::class, 'get']);
        Router::put("/{id}", [Media::class, 'update']);
        Router::post("/", [Media::class, 'create']);
        Router::delete("/{id}", [Media::class, 'delete']);
    });

    Router::mount('/serie', function () {
        Router::get("/", [Serie::class, 'list']);
        Router::get("/{id}", [Serie::class, 'get']);
        Router::put("/{id}", [Serie::class, 'update']);
        Router::post("/", [Serie::class, 'create']);
        Router::delete("/{id}", [Serie::class, 'delete']);
    });

    Router::mount('/move', function () {
        Router::get("/", [Move::class, 'list']);
        Router::get("/{id}", [Move::class, 'get']);
        Router::put("/{id}", [Move::class, 'update']);
        Router::post("/", [Move::class, 'create']);
        Router::delete("/{id}", [Move::class, 'delete']);
    });

    Router::mount('/episode', function () {
        Router::get("/", [Episode::class, 'list']);
        Router::get("/{id}", [Episode::class, 'get']);
        Router::put("/{id}", [Episode::class, 'update']);
        Router::post("/", [Episode::class, 'create']);
        Router::delete("/{id}", [Episode::class, 'delete']);
    });

    Router::mount('/review', function () {
        Router::get("/", [Review::class, 'list']);
        Router::get("/{id}", [Review::class, 'get']);
        Router::put("/{id}", [Review::class, 'update']);
        Router::post("/", [Review::class, 'create']);
        Router::delete("/{id}", [Review::class, 'delete']);
    });
});

