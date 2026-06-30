<?php

class Validador {
    public static function validarInscripcion($datos) {
        $errores = [];

        if (empty($datos["identidad"])) {
            $errores[] = "La identidad es obligatoria.";
        }

        if (empty($datos["nombre"])) {
            $errores[] = "El nombre es obligatorio.";
        }

        if (empty($datos["apellido"])) {
            $errores[] = "El apellido es obligatorio.";
        }

        if (empty($datos["edad"]) || !is_numeric($datos["edad"]) || $datos["edad"] < 1 || $datos["edad"] > 120) {
            $errores[] = "La edad debe ser válida.";
        }

        if (empty($datos["sexo"])) {
            $errores[] = "Debe seleccionar el sexo.";
        }

        if (empty($datos["pais"])) {
            $errores[] = "El país de residencia es obligatorio.";
        }

        if (empty($datos["nacionalidad"])) {
            $errores[] = "La nacionalidad es obligatoria.";
        }

        if (empty($datos["celular"])) {
            $errores[] = "El celular es obligatorio.";
        }

        if (empty($datos["email"]) || !filter_var($datos["email"], FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El correo electrónico no es válido.";
        }

        if (empty($datos["temas"]) || !is_array($datos["temas"])) {
            $errores[] = "Debe seleccionar al menos un tema tecnológico.";
        }

        return $errores;
    }
}