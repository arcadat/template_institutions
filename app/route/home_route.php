<?php

$app->get('/', 'App\Controller\HomeController:home');

$app->post('/signin', 'App\Controller\HomeController:signin');

$app->post('/partials/user', 'App\Controller\HomeController:user');
