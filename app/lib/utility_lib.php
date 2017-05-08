<?php

namespace App\Lib;

use DateTime;
use DateTimeZone;

class UtilityLib
{
    private $coin_symbol;
    private $decimal_separator;
    private $thousands_separator;
    private $decimal;

    function __construct($coin_symbol = '$', $decimal = 2, $decimal_separator=',', $thousands_separator = '.')
    {
        $this->coin_symbol         = $coin_symbol;
        $this->decimal             = $decimal;
        $this->decimal_separator   = $decimal_separator;
        $this->thousands_separator = $thousands_separator;
    }

    public function formatNumber($value='0', $money=false)
    {
        $number = number_format($value, $this->decimal, $this->decimal_separator, $this->thousands_separator);
        if ($money) {
            $number = $this->coin_symbol .' '. $number;
        }
        return $number;
    }

    public function formatDate($date=null, $timezone='GMT', $format='d-m-Y')
    {
        if (!$date) {
            $date = date();
        }
        $return = new DateTime( $date, new DateTimeZone($timezone));

        return $return->format($format);
    }

    public function tiempoTranscurrido($fechaInit)
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
        if ($anos && $meses) {
            $res = $anos . ' y ' . $meses;
        } elseif ($anos) {
            $res = $anos;
        } elseif ($meses) {
            $res = $meses;
        } else {
            $res = 'Menos de un mes';
        }

        return $res . ' de servicio';
    }
}
