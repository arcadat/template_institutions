<?php

$app->get('/students', 'App\Controller\StudentsController:home');

$app->post('/students/partials/{workers}', 'App\Controller\StudentsController:partials');

$app->post('/students/results', 'App\Controller\StudentsController:results');
