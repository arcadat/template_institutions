<?php

$url_api = 'http://arcadat.com/apps/json/web_service/';

$config = [
    'enviroment' => [
        'lc_time'          => 'es_ES.UTF-8',
        'session_lifetime' => '31536000',
    ],
    'api'        => [
        'url_basic'                  => $url_api . 'data_basic_institution/',
        'url_login'                  => $url_api . 'login/',
        'url_logout'                 => $url_api . 'logout/',
        'url_contact'                => $url_api . 'contact_us/default.php',
        'url_recovery'               => $url_api . 'recover_password/',
        'url_register'               => $url_api . 'register_user/',
        'url_fathers'                => $url_api . 'fathers/',
        'url_students'               => $url_api . 'students/',
        'url_results'                => $url_api . 'results_evaluations/',
        'url_teachers'               => $url_api . 'teachers/',
        'url_resource'               => $url_api . 'teaching_resource/',
        'url_refresh'                => $url_api . 'refresh_teachers/',
        'url_absences'               => $url_api . 'absences_students/',
        'url_evaluations'            => $url_api . 'evaluation_plan/',
        'url_results'                => $url_api . 'register_results/',
        'url_absences_save'          => $url_api . 'save_absences/',
        'url_save_qlfs_teacher'      => $url_api . 'save_qlfs_teacher/',
        'url_save_evaluation_plan'   => $url_api . 'save_evaluation_plan/',
        'url_import_evaluation_plan' => $url_api . 'import_evaluation_plan/',
        // ASIGNADOS
        // 'colegioId'               => '2b13572b-e506-4bf6-b908-8d228a6cc01f', // MATERDEI
        // 'colegioId'               => 'e0aef592-5ed5-4f20-a8cc-29c10d9a2db2', // FREDERYCK TAYLOR
        // 'colegioId'               => '07b7c9b3-2c31-42ae-9ef1-21591733f8fe', // NUESTRA SEÑORA DEL VALLE
        // 'colegioId'               => 'b1359b3a-9210-4d7e-a353-e8a0c3506ba0', //UNIDAD EDUCATIVA NUESTRA SEÑORA DE LA ASUNCIÓN
        'colegioId'                  => 'ccc9747b-3a46-4367-a641-46cc97f2a747', // UNIDAD EDUCATIVA COLEGIO CASTELAO
        // 'colegioId'               => '99b23e45-376b-4afd-acb1-78bda55b3968', // UNIDAD EDUCATIVA PRIVADA INSTITUTO DE EDUCACIÓN INTEGRAL
        // SIN ASIGNAR
        // 'colegioId'               => 'b6b4fc42-8252-4535-8f05-ffce89fb7b5d',
        // 'colegioId'               => 'a97d3165-138e-4802-9986-9184ad615560',
        // 'colegioId'               => 'ccc9747b-3a46-4367-a641-46cc97f2a747',
        // 'colegioId'               => 'd3cc3bd2-ddaa-494e-a97d-bfc323669bf4',
        // 'colegioId'               => 'c7e081bf-e6ca-4e10-919f-ec9442b58b5c',
        // 'colegioId'               => '11e93b10-11cb-4f5f-93c2-70551d5b276e',
        // 'colegioId'               => '99b23e45-376b-4afd-acb1-78bda55b3968',
        // 'colegioId'               => '2b046765-5b95-4b6f-a674-b3d8b08e97a6',
        // 'colegioId'               => '9894ca65-7c7f-45ed-878d-8ea998979042',
        // 'colegioId'               => 'ff668758-083a-473c-9a0b-d482b3e58e6d',
        // 'colegioId'               => '07b7c9b3-2c31-42ae-9ef1-21591733f8fe',

    ],
    'api_recaptcha' => [
        'sitekey' => '6LdJ-xUUAAAAAJ8dcUtN1PUEHf1gjWxiNJGC5zoO',
        'secret'  => '6LdJ-xUUAAAAAB9QWlgv18IOsZtn_5eYw7ztJeka',
    ],
];

return $config;
