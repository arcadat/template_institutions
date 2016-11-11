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
    $main_data         = $response->body->main_data;
    $covers            = $response->body->covers;
    $installations     = $response->body->installations;
    $degree            = $response->body->degree;
    $schedule_academic = $response->body->schedule_academic;
    if ($covers->covers) {
        $photos_covers = $covers->photos_covers;
    }
    if ($installations->installations) {
        $photos_installations = $installations->photos_installations;
    }
    if ($degree->degree) {
        $data_degree = $degree->data_degree;
    }
    if ($schedule_academic->schedule) {
        foreach ($schedule_academic->data_schedule as $data) {
            $array_data[] = [
                'title' => $data->description_schedule,
                'start' => date('Y-m-d', strtotime($data->init_schedule->date)),
                'end'   => date('Y-m-d', strtotime($data->end_schedule->date))
            ];
        }
        $data_schedule = json_encode($array_data);
    }
    $tiempoServicio = tiempoTranscurrido($main_data->date_foundation->date);
} else {
    echo 'Error: '.$response->meta_data['http_code'].'<br/>';
    echo '<pre>';
    var_dump($response);
    die();
}

include 'index.html.php';
