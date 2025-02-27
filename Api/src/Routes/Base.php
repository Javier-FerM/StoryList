<?php

use Api\V1\Controller\Episode;
use Api\V1\Controller\Move;
use Api\V1\Controller\Review;
use Api\V1\Controller\Serie;
use Api\V1\Controller\User;

use Cavesman\Router;
use Cavesman\Http\JsonResponse;

Router::mount('/api/v1', function () {
    Router::get('/', fn() => new JsonResponse(['message' => 'Bienvenido a la Base de StoryList']));

    Router::mount('/user', function () {
        /** @see User::list() */
        Router::get("/", User::class. '@list');
        /** @see User::create() */
        Router::post("/", User::class. '@create');
        /** @see User::get() */
        Router::get("/(\d+)", User::class. '@get');
        /** @see User::update() */
        Router::put("/(\d+)", User::class. '@update');
        /** @see User::delete() */
        Router::delete("/(\d+)", User::class. '@delete');
    });

    Router::mount('/serie', function () {
        /** @see Serie::list() */
        Router::get("/", Serie::class.'@list');
        /** @see Serie::create() */
        Router::post("/", Serie::class. '@create');
        /** @see Serie::get() */
        Router::get("/(\d+)", Serie::class. '@get');
        /** @see Serie::update() */
        Router::put("/(\d+)", Serie::class. '@update');
        /** @see Serie::delete() */
        Router::delete("/(\d+)", Serie::class. '@delete');
    });

    Router::mount('/move', function () {
        /** @see Move::list() */
        Router::get("/", Move::class. '@list');
        /** @see Move::update() */
        Router::put("/(\d+)", Move::class. '@update');
        /** @see Move::create() */
        Router::post("/", Move::class. '@create');
        /** @see Move::get() */
        Router::get("/(\d+)", Move::class. '@get');
        /** @see Move::delete() */
        Router::delete("/(\d+)", Move::class. '@delete');
    });

    Router::mount('/episode', function () {
        /** @see Episode::list() */
        Router::get("/", Episode::class. '@list');
        /** @see Episode::create() */
        Router::post("/", Episode::class. '@create');
        /** @see Episode::get() */
        Router::get("/(\d+)", Episode::class. '@get');
        /** @see Episode::update() */
        Router::put("/(\d+)", Episode::class. '@update');
        /** @see Episode::delete() */
        Router::delete("/(\d+)", Episode::class. '@delete');
    });

    Router::mount('/review', function () {
        /** @see Review::list() */
        Router::get("/", Review::class. '@list');
        /** @see Review::create() */
        Router::post("/", Review::class. '@create');
        /** @see Review::get() */
        Router::get("/(\d+)", Review::class. '@get');
        /** @see Review::update() */
        Router::put("/(\d+)", Review::class. '@update');
        /** @see Review::delete() */
        Router::delete("/(\d+)", Review::class. '@delete');
    });

});

