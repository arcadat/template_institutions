<?php

namespace App\Controller;

use App\Lib\UtilityLib;
use DateTime;
use \Httpful\Http;
use \Httpful\Mime;
use \Httpful\Request;

class FathersController extends Controller
{

    public function home($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template 'fathers/home' route");

        $data = [
            't'         => (isset($_SESSION['token'])) ? $_SESSION['token'] : $_GET['token'],
        ];

        $uri = $this->container->config->api->url_fathers . '?' . http_build_query($data);

        $response = Request::get($uri)->send();

        if ($response->meta_data['http_code'] != 200) {
            echo 'Error: ' . $response->meta_data['http_code'] . '<br/>';
            echo '<pre>';
            // var_dump($response);
            die();
        }

        if ($response->body->result->number_error != '0') {
            session_destroy();
            return $res->withRedirect('/');
        }

        $utility = new UtilityLib(
            $response->body->settings->coin_symbol,
            2,
            $response->body->settings->decimal_separator,
            $response->body->settings->thousands_separator
            );

        $response->body->settings->token = (isset($_SESSION['token'])) ? '' : $data['t'];

        $args = [
            'settings' => $response->body->settings,
            'person'   => $response->body->person,
            'sons'     => $response->body->sons,
            'utility'  => $utility,
        ];

        // Render view
        return $this->container->renderer->render($res, 'fathers/index.phtml', $args);
    }

    public function partials($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/fathers/partials/{$args['workers']}' route");

        switch ($args['workers']) {
            case 'results':
                $file = 'fathers/partials/results.phtml';
                break;

            default:
                $file = '404.phtml';
                break;
        }

        $data = $req->getParsedBody();

        $args = [
            'datos' => $data,
        ];

        // Render view
        return $this->container->renderer->render($res, $file, $args);
    }

    public function results($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template 'fathers/results' route");

        $data = $req->getParsedBody();
        if (isset($_SESSION['token'])) {
            $data['t'] = $_SESSION['token'];
        }


        $uri = $this->container->config->api->url_results . '?' . http_build_query($data);

        $response = Request::get($uri)->send();

        if ($response->meta_data['http_code'] != 200) {
            echo 'Error: ' . $response->meta_data['http_code'] . '<br/>';
            echo '<pre>';
            // var_dump($response);
            die();
        }

        // Render Json view
        return $res->withHeader('Content-type', 'application/json')->write($response);
    }
}
