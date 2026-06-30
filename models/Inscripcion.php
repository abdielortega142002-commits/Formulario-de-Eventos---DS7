<?php

require_once __DIR__ . "/../app/config/Database.php";

class Inscripcion {
    private $conexion;

    public function __construct() {
        $this->conexion = Database::conectar();
    }

    public function guardar($datos) {
        try {
            $this->conexion->beginTransaction();

            $sql = "INSERT INTO inscripciones 
                    (identidad, nombre, apellido, edad, sexo, pais, nacionalidad, celular, email, observaciones, firma)
                    VALUES 
                    (:identidad, :nombre, :apellido, :edad, :sexo, :pais, :nacionalidad, :celular, :email, :observaciones, :firma)";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([
                ":identidad" => $datos["identidad"],
                ":nombre" => $datos["nombre"],
                ":apellido" => $datos["apellido"],
                ":edad" => $datos["edad"],
                ":sexo" => $datos["sexo"],
                ":pais" => $datos["pais"],
                ":nacionalidad" => $datos["nacionalidad"],
                ":celular" => $datos["celular"],
                ":email" => $datos["email"],
                ":observaciones" => $datos["observaciones"],
                ":firma" => $datos["firma"]
            ]);

            $inscripcionId = $this->conexion->lastInsertId();

            foreach ($datos["temas"] as $tema) {
                $temaId = $this->obtenerTemaId($tema);

                if ($temaId) {
                    $sqlTema = "INSERT INTO inscripcion_temas (inscripcion_id, tema_id)
                                VALUES (:inscripcion_id, :tema_id)";

                    $stmtTema = $this->conexion->prepare($sqlTema);

                    $stmtTema->execute([
                        ":inscripcion_id" => $inscripcionId,
                        ":tema_id" => $temaId
                    ]);
                }
            }

            $this->conexion->commit();

            return true;

        } catch (Exception $e) {
            $this->conexion->rollBack();
            throw $e;
        }
    }

    private function obtenerTemaId($nombreTema) {
        $sql = "SELECT id FROM temas WHERE nombre = :nombre LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([":nombre" => $nombreTema]);

        $tema = $stmt->fetch();

        return $tema ? $tema["id"] : null;
    }

    public function listar() {
        $sql = "SELECT 
                    i.id,
                    i.identidad,
                    i.nombre,
                    i.apellido,
                    i.edad,
                    i.sexo,
                    i.pais,
                    i.nacionalidad,
                    i.celular,
                    i.email,
                    i.observaciones,
                    i.firma,
                    i.fecha_registro,
                    GROUP_CONCAT(t.nombre ORDER BY t.nombre SEPARATOR ', ') AS temas_texto
                FROM inscripciones i
                LEFT JOIN inscripcion_temas it ON i.id = it.inscripcion_id
                LEFT JOIN temas t ON it.tema_id = t.id
                GROUP BY i.id
                ORDER BY i.fecha_registro DESC";

        $stmt = $this->conexion->query($sql);

        return $stmt->fetchAll();
    }
}