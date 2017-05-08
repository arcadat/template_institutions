<?php

$app->get(
    '/teachers',
    'App\Controller\TeachersController:home'
);

$app->post(
    '/teachers/partials/{workers}',
    'App\Controller\TeachersController:partials'
);

$app->post(
    '/teachers/results',
    'App\Controller\TeachersController:results'
);

$app->post(
    '/teachers/resource',
    'App\Controller\TeachersController:resource'
);

$app->post(
    '/teachers/refreshTab',
    'App\Controller\TeachersController:refreshTab'
);

$app->post(
    '/teachers/classapp/{workers}',
    'App\Controller\TeachersController:classapp'
);

$app->post(
    '/teachers/absences_save',
    'App\Controller\TeachersController:absencesSave'
);

$app->post(
    '/teachers/save_qlfs_teacher',
    'App\Controller\TeachersController:saveQlfsTeacher'
);

$app->post(
    '/teachers/save_evaluation_plan',
    'App\Controller\TeachersController:saveEvaluationPlan'
);

$app->post(
    '/teachers/import_evaluation_plan',
    'App\Controller\TeachersController:importEvaluationPlan'
);
