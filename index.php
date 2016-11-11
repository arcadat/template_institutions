<?php

setlocale(LC_TIME, 'es_ES.UTF-8');

require 'vendor/autoload.php';

function tiempoTranscurrido($fechaInit)
{
    $fechaInit = new DateTime($fechaInit);
    $fechaActu = new DateTime();
    $fechaResp = $fechaInit->diff($fechaActu);
    $anos      = null;
    $meses     = null;

    if ($fechaResp->y > 0) {
        $anos = $fechaResp->y . ' años';
    }
    if ($fechaResp->m > 0) {
        $meses = $fechaResp->m . ' meses';
    }
    if ($anos && $meses) $res = $anos . ' y ' . $meses;
    elseif ($anos) $res = $anos;
    elseif ($meses) $res = $meses;
    else $res = 'Menos de un mes';

    return $res . ' de servicio';
}

$uri      = "http://arcadat.com/apps/json/data_basic_institution/?i_i=2b13572b-e506-4bf6-b908-8d228a6cc01f";
$response = \Httpful\Request::get($uri)->send();

if ($response->meta_data['http_code'] == 200) {
    $main_data     = $response->body->main_data;
    $covers        = $response->body->covers;
    $installations = $response->body->installations;
    $degree        = $response->body->degree;
    if ($covers->covers) {
        $photos_covers = $covers->photos_covers;
    }
    if ($installations->installations) {
        $photos_installations = $installations->photos_installations;
    }
    if ($degree->degree) {
        $data_degree = $degree->data_degree;
    }
    $tiempoServicio = tiempoTranscurrido($main_data->date_foundation->date);
} else {
    echo 'Error: '.$response->meta_data['http_code'].'<br/>';
    echo '<pre>';
    var_dump($response);
    die();
}

include 'index.html.php';
