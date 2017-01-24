<?php

namespace App\Lib;

use DateTime;

class UtilityLib
{
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
