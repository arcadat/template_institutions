<?php

$config = [
    'enviroment' => [
        'lc_time' => 'es_ES.UTF-8',
    ],
    'api'        => [
        'url_basic'    => 'http://arcadat.com/apps/json/web_service/data_basic_institution/?i_i=',
        'url_login'    => 'http://arcadat.com/apps/json/web_service/login/',
        'url_contact'  => 'http://arcadat.com/apps/json/web_service/contact_us/default.php',
        'url_recovery' => 'http://arcadat.com/apps/json/web_service/recover_password/',
        'url_register' => 'http://arcadat.com/apps/json/web_service/register_user/',
        'url_fathers'  => 'http://arcadat.com/apps/json/web_service/fathers/',
        'url_students' => 'http://arcadat.com/apps/json/web_service/students/',
        'url_results'  => 'http://arcadat.com/apps/json/web_service/results_evaluations/',
        // ASIGNADOS
        // 'colegioId' => '2b13572b-e506-4bf6-b908-8d228a6cc01f',
        // 'colegioId' => 'e0aef592-5ed5-4f20-a8cc-29c10d9a2db2',
        // 'colegioId' => '07b7c9b3-2c31-42ae-9ef1-21591733f8fe',
        'colegioId' => 'b1359b3a-9210-4d7e-a353-e8a0c3506ba0',
        // 'colegioId' => 'ccc9747b-3a46-4367-a641-46cc97f2a747',
        // 'colegioId'    => '99b23e45-376b-4afd-acb1-78bda55b3968',
        // SIN ASIGNAR
        // 'colegioId' => 'b6b4fc42-8252-4535-8f05-ffce89fb7b5d',
        // 'colegioId' => 'a97d3165-138e-4802-9986-9184ad615560',
        // 'colegioId' => 'ccc9747b-3a46-4367-a641-46cc97f2a747',
        // 'colegioId' => 'd3cc3bd2-ddaa-494e-a97d-bfc323669bf4',
        // 'colegioId' => 'c7e081bf-e6ca-4e10-919f-ec9442b58b5c',
        // 'colegioId' => '11e93b10-11cb-4f5f-93c2-70551d5b276e',
        // 'colegioId' => '99b23e45-376b-4afd-acb1-78bda55b3968',
        // 'colegioId' => '2b046765-5b95-4b6f-a674-b3d8b08e97a6',
        // 'colegioId' => '9894ca65-7c7f-45ed-878d-8ea998979042',
        // 'colegioId' => 'ff668758-083a-473c-9a0b-d482b3e58e6d',
        // 'colegioId' => '07b7c9b3-2c31-42ae-9ef1-21591733f8fe',

    ],
    'api_recaptcha' => [
        'sitekey' => '6LdJ-xUUAAAAAJ8dcUtN1PUEHf1gjWxiNJGC5zoO',
        'secret' => '6LdJ-xUUAAAAAB9QWlgv18IOsZtn_5eYw7ztJeka',
    ],
];

return $config;
