<?php

require_once __DIR__ . "/../models/Inscripcion.php";
require_once __DIR__ . "/../service/Sanitizador.php";
require_once __DIR__ . "/../service/Validador.php";
require_once __DIR__ . "/../service/Integridad.php";

class InscripcionController {
    public function guardar($post) {
        $errores = Validador::validarInscripcion($post);

        if (!empty($errores)) {
            $this->mostrarErrores($errores);
            return;
        }

        try {
            $temasLimpios = Sanitizador::limpiarArray($post["temas"]);

            $datos = [
                "identidad" => Sanitizador::limpiarTexto($post["identidad"]),
                "nombre" => Sanitizador::formatoTitulo($post["nombre"]),
                "apellido" => Sanitizador::formatoTitulo($post["apellido"]),
                "edad" => (int) $post["edad"],
                "sexo" => Sanitizador::limpiarTexto($post["sexo"]),
                "pais" => Sanitizador::limpiarTexto($post["pais"]),
                "nacionalidad" => Sanitizador::limpiarTexto($post["nacionalidad"]),
                "celular" => Sanitizador::limpiarTexto($post["celular"]),
                "email" => Sanitizador::limpiarEmail($post["email"]),
                "observaciones" => Sanitizador::limpiarTexto($post["observaciones"] ?? ""),
                "temas" => $temasLimpios
            ];

            $datos["firma"] = Integridad::firmar($datos);

            $modelo = new Inscripcion();
            $modelo->guardar($datos);

            header("Location: reporte.php?ok=1");
            exit;

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $this->mostrarErrores(["Ya existe una inscripción con esa identidad."]);
            } else {
                $this->mostrarErrores(["Error en la base de datos: " . $e->getMessage()]);
            }

        } catch (Exception $e) {
            $this->mostrarErrores(["Error general: " . $e->getMessage()]);
        }
    }

    private function mostrarErrores($errores) {
        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<title>Errores</title>";
        echo "<link rel='stylesheet' href='assets/css/styles.css'>";
        echo "</head>";
        echo "<body>";
        echo "<main class='contenedor'>";
        echo "<h1>Errores encontrados</h1>";
        echo "<div class='mensaje-error'>";
        echo "<ul>";

        foreach ($errores as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }

        echo "</ul>";
        echo "</div>";
        echo "<a class='btn-link' href='index.php'>Volver al formulario</a>";
        echo "</main>";
        echo "</body>";
        echo "</html>";
    }
}