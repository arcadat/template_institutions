<?php

setlocale(LC_TIME, 'es_ES.UTF-8');

require 'vendor/autoload.php';

use \Httpful\Http;
use \Httpful\Mime;
use \Httpful\Request;

$user = $_POST['user'];
$pass = $_POST['pass'];
$cole = $_POST['cole'];

$data = ['i_i'=>$cole, 'u'=>$user, 'p'=>$pass];

$uri = 'http://arcadat.com/apps/json/web_service/login/';

$response = Request::post($uri)
->method(Http::POST)
->withoutStrictSsl()
->expectsJson()
->sendsType(Mime::FORM)
->body($data)
->send();

// var_dump($response);

header('Content-type: application/json');
echo $response;
