<?php

$app->get('/', 'App\Controller\HomeController:home');

$app->post('/', 'App\Controller\HomeController:home');

$app->get('/colegio', 'App\Controller\HomeController:colegio');

$app->post('/signin', 'App\Controller\HomeController:signin');

$app->post('/partials/{workers}', 'App\Controller\HomeController:partials');
