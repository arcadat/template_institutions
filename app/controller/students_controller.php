<?php

namespace App\Controller;

use App\Lib\UtilityLib;
use DateTime;
use \Httpful\Http;
use \Httpful\Mime;
use \Httpful\Request;

class StudentsController extends Controller
{

    public function home($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template 'students/home' route");

        $data = [
            'option'    => '1',
            'i_i'       => $_SESSION['idco'],
            't'         => (isset($_SESSION['token'])) ? $_SESSION['token'] : $_GET['token'],
            'id_person' => (isset($_SESSION['idper'])) ? $_SESSION['idper'] : $_GET['idper'],
        ];

        $uri = $this->container->config->api->url_students . '?' . http_build_query($data);

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
            'student'   => $response->body->student,
            'utility'  => $utility,
        ];

        // Render view
        return $this->container->renderer->render($res, 'students/index.phtml', $args);
    }

    public function partials($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/students/partials/{$args['workers']}' route");

        switch ($args['workers']) {
            case 'results':
                $file = 'students/partials/results.phtml';
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
        $this->container->logger->info("Arcadat Template 'students/results' route");

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
