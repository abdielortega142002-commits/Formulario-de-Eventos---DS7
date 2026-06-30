<?php

class Integridad {
    private static $clave = "clave_secreta_itech_2026";

    public static function crearCadenaDatos($datos) {
        $temas = "";

        if (isset($datos["temas"]) && is_array($datos["temas"])) {
            $temasArray = $datos["temas"];
            sort($temasArray);
            $temas = implode(", ", $temasArray);
        } elseif (isset($datos["temas_texto"])) {
            $temas = $datos["temas_texto"];
        }

        return implode("|", [
            $datos["identidad"] ?? "",
            $datos["nombre"] ?? "",
            $datos["apellido"] ?? "",
            $datos["edad"] ?? "",
            $datos["sexo"] ?? "",
            $datos["pais"] ?? "",
            $datos["nacionalidad"] ?? "",
            $datos["celular"] ?? "",
            $datos["email"] ?? "",
            $temas,
            $datos["observaciones"] ?? ""
        ]);
    }

    public static function firmar($datos) {
        $cadena = self::crearCadenaDatos($datos);
        return hash_hmac("sha256", $cadena, self::$clave);
    }

    public static function verificar($datos, $firmaGuardada) {
        $cadena = self::crearCadenaDatos($datos);
        $firmaActual = hash_hmac("sha256", $cadena, self::$clave);

        return hash_equals($firmaActual, $firmaGuardada);
    }
}