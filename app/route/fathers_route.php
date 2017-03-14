<?php

$app->get('/fathers', 'App\Controller\FathersController:home');

$app->post('/fathers/partials/{workers}', 'App\Controller\FathersController:partials');

$app->post('/fathers/results', 'App\Controller\FathersController:results');
