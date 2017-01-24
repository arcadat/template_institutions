<?php

namespace App\Controller;

use App\Lib\UtilityLib;
use DateTime;
use \Httpful\Http;
use \Httpful\Mime;
use \Httpful\Request;

class HomeController extends Controller
{

    public function home($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/' route");

        $uri = $this->container->config->api->url_basic . $this->container->config->api->colegioId;

        $response = Request::get($uri)->send();

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
                    $start = new DateTime($data->init_schedule->date);
                    $end   = new DateTime($data->end_schedule->date);
                    $end->modify('+1 day');
                    $array_data[] = [
                        'title'     => $data->description_schedule,
                        'start'     => $start->format('Y-m-d'),
                        'end'       => $end->format('Y-m-d'),
                        'color'     => $data->color_schedule,
                        'textColor' => ($data->color_schedule == 'white') ? 'black' : 'white',
                    ];
                }
            } else {
                $array_data = [];
            }
            $data_schedule  = json_encode($array_data);
            $tiempoServicio = UtilityLib::tiempoTranscurrido($main_data->date_foundation->date);

            $args = [
                'main_data'            => $main_data,
                'covers'               => $covers,
                'photos_covers'        => $photos_covers,
                'installations'        => $installations,
                'photos_installations' => $photos_installations,
                'degree'               => $degree,
                'data_degree'          => $data_degree,
                'data_schedule'        => $data_schedule,
                'tiempoServicio'       => $tiempoServicio,
            ];

            $file = 'index.phtml';
        } else {
            echo 'Error: ' . $response->meta_data['http_code'] . '<br/>';
            echo '<pre>';
            var_dump($response);
            die();
            $file = 'index.phtml';
        }

        // Render view
        return $this->container->renderer->render($res, $file, $args);
    }

    public function signin($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/signin' route");

        $data = $req->getParsedBody();

        $data = [
            'i_i' => $this->container->config->api->colegioId,
            'u' => $data['user'],
            'p' => $data['pass']
        ];

        $uri = $this->container->config->api->url_login;

        $response = Request::post($uri)
            ->method(Http::POST)
            ->withoutStrictSsl()
            ->expectsJson()
            ->sendsType(Mime::FORM)
            ->body($data)
            ->send();

        // Render Json view
        return $res->withHeader('Content-type', 'application/json')->write($response);
    }

    public function user($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/partials/user' route");

        $data = $req->getParsedBody();

        $args = [
            'datos' => $data['person'],
        ];

        // Render view
        return $this->container->renderer->render($res, 'user.phtml', $args);
    }
}