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

        if ($req->isPost()) {
            $data = $req->getParsedBody();
            $data = $data['id_col'];
            $_SESSION['idco'] = $data;
        } else {
            $data = (isset($_SESSION['idco'])) ? $_SESSION['idco'] : $this->container->config->api->colegioId;
        }

        $uri = $this->container->config->api->url_basic . $data;

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
                'recaptcha_sitekey'    => $this->container->config->api_recaptcha->sitekey,
            ];

            $file = 'home/index.phtml';
        } else {
            echo 'Error: ' . $response->meta_data['http_code'] . '<br/>';
            echo '<pre>';
            var_dump($response);
            die();
        }

        // Render view
        return $this->container->renderer->render($res, $file, $args);
    }

    public function colegio($req, $res, $args)
    {
        session_destroy();
        // Log message
        $this->container->logger->info("Arcadat Template '/colegio' route");

        // Render view
        return $this->container->renderer->render($res, 'home/frm_col_id.phtml', $args);
    }

    public function signin($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/signin' route");

        $data = $req->getParsedBody();
        $data['idco'] = (isset($_SESSION['idco'])) ? $_SESSION['idco'] : $this->container->config->api->colegioId;

        if ($data['tn'] >= 3) {
            $recaptcha = new \ReCaptcha\ReCaptcha($this->container->config->api_recaptcha->secret);
            $resp = $recaptcha->verify($data['rcode'], $_SERVER['REMOTE_ADDR']);
            if (!$resp->isSuccess()) {
                $response = json_encode([
                        'result' => [
                            'number_error' => 70,
                            'msg_error' => 'Falló el cheque de seguridad reCaptcha'
                        ]
                    ]);
                return $res->withHeader('Content-type', 'application/json')->write($response);
            }
        }

        if (isset($_SESSION['user'])) {
            $data['idco']  = $_SESSION['idco'];
            $data['user']  = $_SESSION['user'];
            $data['pass']  = $_SESSION['pass'];
            $data['check'] = $_SESSION['check'];
        } elseif ($data['check']=='true') {
            $_SESSION['idco']  = $data['idco'];
            $_SESSION['user']  = $data['user'];
            $_SESSION['pass']  = $data['pass'];
            $_SESSION['check'] = $data['check'];
        }

        $data = [
            'i_i' => $data['idco'],
            'u'   => $data['user'],
            'p'   => $data['pass'],
            'ncs' => $data['check']
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

    public function signout($req, $res, $args)
    {
        session_destroy();
        return $res->withRedirect('/');
    }

    public function partials($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/home/partials/{$args['workers']}' route");

        switch ($args['workers']) {
            case 'administrative':
                $file = 'home/partials/administrative.phtml';
                break;
            case 'appmenu':
                $file = 'home/partials/apps.phtml';
                break;
            case 'authorities':
                $file = 'home/partials/authorities.phtml';
                break;
            case 'birthdays':
                $file = 'home/partials/birthdays.phtml';
                break;
            case 'honor':
                $file = 'home/partials/honor.phtml';
                break;
            case 'recovery':
                $file = 'home/partials/recovery.phtml';
                break;
            case 'register':
                $file = 'home/partials/register.phtml';
                break;
            case 'register2':
                $file = 'home/partials/register2.phtml';
                break;
            case 'teachers':
                $file = 'home/partials/teachers.phtml';
                break;
            case 'user':
                $file = 'home/partials/user.phtml';
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

    public function contact($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/contact' route");

        $recaptcha = new \ReCaptcha\ReCaptcha($this->container->config->api_recaptcha->secret);

        $data = $req->getParsedBody();
        $resp = $recaptcha->verify($data['recaptcha'], $_SERVER['REMOTE_ADDR']);

        if ($resp->isSuccess()) {
            $data['idco'] = (isset($_SESSION['idco'])) ? $_SESSION['idco'] : $this->container->config->api->colegioId;
            $data = [
                'i_i'     => $data['idco'],
                'name'    => $data['name'],
                'email'   => $data['email'],
                'subject' => $data['subject'],
                'message' => $data['message'],
                'send_to' => $data['send_to']
            ];

            $uri = $this->container->config->api->url_contact;

            $response = Request::post($uri)
                ->method(Http::POST)
                ->withoutStrictSsl()
                ->expectsJson()
                ->sendsType(Mime::FORM)
                ->body($data)
                ->send();
        } else{
            $response = json_encode([
                    'result' => [
                        'number_error' => 70,
                        'msg_error' => 'Falló el cheque de seguridad reCaptcha'
                    ]
                ]);
        }

        // Render Json view
        return $res->withHeader('Content-type', 'application/json')->write($response);
    }

    public function recovery($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/recovery' route");

        $data = $req->getParsedBody();
        $data = [
            'em'     => $data['email'],
        ];

        $uri = $this->container->config->api->url_recovery;

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

    public function register($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/register' route");

        $recaptcha = new \ReCaptcha\ReCaptcha($this->container->config->api_recaptcha->secret);

        $data = $req->getParsedBody();
        $resp = $recaptcha->verify($data['recaptcha'], $_SERVER['REMOTE_ADDR']);

        if ($resp->isSuccess()) {
            $data['idco'] = (isset($_SESSION['idco'])) ? $_SESSION['idco'] : $this->container->config->api->colegioId;
            $data = [
                'i_i'     => $data['idco'],
                'id'     => $data['id'],
                'db'     => $data['date'],
                'option' => $data['op'],
            ];

            $uri = $this->container->config->api->url_register;

            $response = Request::post($uri)
                ->method(Http::POST)
                ->withoutStrictSsl()
                ->expectsJson()
                ->sendsType(Mime::FORM)
                ->body($data)
                ->send();
        } else {
            $response = json_encode([
                    'result' => [
                        'number_error' => 70,
                        'msg_error' => 'Falló el cheque de seguridad reCaptcha'
                    ]
                ]);
        }

        // Render Json view
        return $res->withHeader('Content-type', 'application/json')->write($response);
    }

    public function register2($req, $res, $args)
    {
        // Log message
        $this->container->logger->info("Arcadat Template '/register2' route");

        $data = $req->getParsedBody();

        $data['idco'] = (isset($_SESSION['idco'])) ? $_SESSION['idco'] : $this->container->config->api->colegioId;
        $data = [
            'i_i'       => $data['idco'],
            'id_person' => $data['id'],
            'em'        => $data['email'],
            'option'    => $data['op'],
        ];

        $uri = $this->container->config->api->url_register;

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
}
