<?php

namespace App\Controller;

use App\Lib\UtilityLib;
use \Httpful\Http;
use \Httpful\Mime;
use \Httpful\Request;

class TeachersController extends Controller
{

    public function home($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template 'teachers/home' route");

        $data = [
            't' => (isset($_SESSION['token'])) ? $_SESSION['token'] : $_GET['token'],
        ];

        $uri = $this->container->config->api->url_teachers . '?' . http_build_query($data);

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
            'settings'             => $response->body->settings,
            'data_teacher'         => $response->body->teacher->data_teacher,
            'teaching_resources'   => $response->body->teacher->teaching_resources,
            'documents_teacher'    => $response->body->teacher->documents_teacher,
            'publications_teacher' => $response->body->teacher->publications_teacher,
            'tutorials_teacher'    => $response->body->teacher->tutorials_teacher,
            'class_teacher'        => $response->body->teacher->class_teacher,
        ];

        // Render view
        return $this->container->renderer->render($res, 'teachers/index.phtml', $args);
    }

    public function partials($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/teachers/partials/{$args['workers']}' route");

        switch ($args['workers']) {
            case 'results':
                $file = 'teachers/partials/results.phtml';
                break;
            case 'data_teacher':
                $file = 'teachers/partials/data.phtml';
                break;
            case 'documents_teacher':
                $file = 'teachers/partials/documents.phtml';
                break;
            case 'tutorials_teacher':
                $file = 'teachers/partials/tutorials.phtml';
                break;
            case 'class_teacher':
                $file = 'teachers/partials/class.phtml';
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
        $this->container->logger->info("Arcadat Template 'teachers/results' route");

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

    public function resource($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template 'teachers/resource' route");

        $data = $req->getParsedBody();
        if (isset($_SESSION['token'])) {
            $data['t'] = $_SESSION['token'];
        }

        $uri = $this->container->config->api->url_resource;

        $response = Request::post($uri)
            ->method(Http::POST)
            ->withoutStrictSsl()
            ->expectsJson()
            ->sendsType(Mime::FORM)
            ->body($data)
            ->send();

        if ($response->meta_data['http_code'] != 200) {
            $response = json_encode([
                'result' => [
                    'number_error' => $response->meta_data['http_code'],
                    'msg_error' => 'Fallo en petición HTTP'
                ]
            ]);
        }

        // Render Json view
        return $res->withHeader('Content-type', 'application/json')->write($response);
    }

    public function refreshTab($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template 'teachers/refreshTab' route");

        $data = $req->getParsedBody();
        if (isset($_SESSION['token'])) {
            $data['t'] = $_SESSION['token'];
        }

        $uri = $this->container->config->api->url_refresh;

        $response = Request::post($uri)
            ->method(Http::POST)
            ->withoutStrictSsl()
            ->expectsJson()
            ->sendsType(Mime::FORM)
            ->body($data)
            ->send();

        if ($response->meta_data['http_code'] != 200) {
            $response = json_encode([
                'result' => [
                    'number_error' => $response->meta_data['http_code'],
                    'msg_error' => 'Fallo en petición HTTP'
                ]
            ]);
        }

        // Render Json view
        return $res->withHeader('Content-type', 'application/json')->write($response);
    }

    public function classapp($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/teachers/classapp/{$args['workers']}' route");

        $data = $req->getParsedBody();
        if (isset($_SESSION['token'])) {
            $data['t'] = $_SESSION['token'];
        }

        switch ($args['workers']) {
            case 'absences':
                $file = 'teachers/classapp/absences.phtml';
                $data['params']['date'] = date('d-m-Y');
                break;
            case 'results':
                $file = 'teachers/classapp/results.phtml';
                break;
            case 'evaluations':
                $file = 'teachers/classapp/evaluations.phtml';
                break;
            default:
                $file = '404.phtml';
                break;
        }

        $svc = "url_{$args['workers']}";
        $uri = $this->container->config->api->$svc;

        $response = Request::post($uri)
            ->method(Http::POST)
            ->withoutStrictSsl()
            ->expectsJson()
            ->sendsType(Mime::FORM)
            ->body($data['params'])
            ->send();

        if ($response->meta_data['http_code'] != 200) {
            $response = json_encode([
                'result' => [
                    'number_error' => $response->meta_data['http_code'],
                    'msg_error' => 'Fallo en petición HTTP'
                ]
            ]);
        }

        $utility = new UtilityLib('#', 1, '.', ',');

        $args = [
            'header'  => $data['header'],
            'params'  => $data['params'],
            'datos'   => $response->body,
            'utility' => $utility,
        ];

        // Render view
        return $this->container->renderer->render($res, $file, $args);
    }

    public function absencesSave($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template 'teachers/absences_save' route");

        $data = $req->getParsedBody();
        if (isset($_SESSION['token'])) {
            $data['t'] = $_SESSION['token'];
        }

        $data['date'] = date('d-m-Y');

        $uri = $this->container->config->api->url_absences_save;

        $response = Request::post($uri)
            ->method(Http::POST)
            ->withoutStrictSsl()
            ->expectsJson()
            ->sendsType(Mime::FORM)
            ->body($data)
            ->send();

        if ($response->meta_data['http_code'] != 200) {
            $response = json_encode([
                'result' => [
                    'number_error' => $response->meta_data['http_code'],
                    'msg_error' => 'Fallo en petición HTTP'
                ]
            ]);
        }

        // Render Json view
        return $res->withHeader('Content-type', 'application/json')->write($response);
    }

    public function saveQlfsTeacher($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template 'teachers/save_qlfs_teacher' route");

        $data = $req->getParsedBody();
        if (isset($_SESSION['token'])) {
            $data['t'] = $_SESSION['token'];
        }

        $uri = $this->container->config->api->url_save_qlfs_teacher;

        $response = Request::post($uri)
            ->method(Http::POST)
            ->withoutStrictSsl()
            ->expectsJson()
            ->sendsType(Mime::FORM)
            ->body($data)
            ->send();

        if ($response->meta_data['http_code'] != 200) {
            $response = json_encode([
                'result' => [
                    'number_error' => $response->meta_data['http_code'],
                    'msg_error' => 'Fallo en petición HTTP'
                ]
            ]);
        }

        // Render Json view
        return $res->withHeader('Content-type', 'application/json')->write($response);
    }

    public function saveEvaluationPlan($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template 'teachers/save_evaluation_plan' route");

        $data = $req->getParsedBody();
        if (isset($_SESSION['token'])) {
            $data['t'] = $_SESSION['token'];
        }

        $uri = $this->container->config->api->url_save_evaluation_plan;

        $response = Request::post($uri)
            ->method(Http::POST)
            ->withoutStrictSsl()
            ->expectsJson()
            ->sendsType(Mime::FORM)
            ->body($data)
            ->send();

        if ($response->meta_data['http_code'] != 200) {
            $response = json_encode([
                'result' => [
                    'number_error' => $response->meta_data['http_code'],
                    'msg_error' => 'Fallo en petición HTTP'
                ]
            ]);
        }

        // Render Json view
        return $res->withHeader('Content-type', 'application/json')->write($response);
    }

    public function importEvaluationPlan($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template 'teachers/import_evaluation_plan' route");

        $data = $req->getParsedBody();
        if (isset($_SESSION['token'])) {
            $data['t'] = $_SESSION['token'];
        }


        $uri = $this->container->config->api->url_import_evaluation_plan . '?' . http_build_query($data);

        $response = Request::get($uri)->send();

        if ($response->meta_data['http_code'] != 200) {
            $response = json_encode([
                'result' => [
                    'number_error' => $response->meta_data['http_code'],
                    'msg_error' => 'Fallo en petición HTTP'
                ]
            ]);
        }

        // Render Json view
        return $res->withHeader('Content-type', 'application/json')->write($response);
    }
}
