<?php

class Sanitizador {
    public static function limpiarTexto($valor) {
        return htmlspecialchars(trim($valor), ENT_QUOTES, "UTF-8");
    }

    public static function limpiarEmail($email) {
        return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    }

    public static function formatoTitulo($valor) {
        $valor = trim($valor);

        if (function_exists("mb_strtolower") && function_exists("mb_convert_case")) {
            $valor = mb_strtolower($valor, "UTF-8");
            return mb_convert_case($valor, MB_CASE_TITLE, "UTF-8");
        }

        return ucwords(strtolower($valor));
    }

    public static function limpiarArray($array) {
        $limpios = [];

        foreach ($array as $item) {
            $limpios[] = self::limpiarTexto($item);
        }

        sort($limpios);

        return $limpios;
    }
}