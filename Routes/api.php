<?php

use App\Middlewares\ProccessRawBody;
use Pecee\SimpleRouter\SimpleRouter as Router;
use App\Controllers\FutureController;


Router::group(['middleware' => [ProccessRawBody::class]], function () {
    Router::group(['prefix' => 'api/v1'], function () {
        Router::get('future', [FutureController::class, 'actionIndex']);
    });
});
