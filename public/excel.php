<?php

require_once __DIR__ . "/../models/Inscripcion.php";
require_once __DIR__ . "/../service/Integridad.php";

$modelo = new Inscripcion();
$inscripciones = $modelo->listar();

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporte_inscripciones.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<html>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "</head>";
echo "<body>";

echo "<table border='1'>";

echo "<tr style='background-color:#0f3d5e; color:white; font-weight:bold;'>";
echo "<th>ID</th>";
echo "<th>Identidad</th>";
echo "<th>Nombre</th>";
echo "<th>Apellido</th>";
echo "<th>Edad</th>";
echo "<th>Sexo</th>";
echo "<th>País</th>";
echo "<th>Nacionalidad</th>";
echo "<th>Celular</th>";
echo "<th>Email</th>";
echo "<th>Temas</th>";
echo "<th>Observaciones</th>";
echo "<th>Integridad</th>";
echo "<th>Fecha de registro</th>";
echo "</tr>";

foreach ($inscripciones as $item) {
    $valido = Integridad::verificar($item, $item["firma"]);
    $estado = $valido ? "Validado" : "Corrupto";

    echo "<tr>";
    echo "<td>" . htmlspecialchars($item["id"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["identidad"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["nombre"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["apellido"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["edad"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["sexo"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["pais"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["nacionalidad"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["celular"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["email"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["temas_texto"] ?? "") . "</td>";
    echo "<td>" . htmlspecialchars($item["observaciones"] ?? "") . "</td>";
    echo "<td>" . $estado . "</td>";
    echo "<td>" . htmlspecialchars($item["fecha_registro"]) . "</td>";
    echo "</tr>";
}

echo "</table>";

echo "</body>";
echo "</html>";