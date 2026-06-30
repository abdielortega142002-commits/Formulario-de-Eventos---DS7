<?php

require_once __DIR__ . "/../models/Inscripcion.php";
require_once __DIR__ . "/../service/Integridad.php";

$modelo = new Inscripcion();
$inscripciones = $modelo->listar();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Inscripciones</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <main class="contenedor reporte">
        <h1>Reporte de Inscripciones</h1>

        <?php if (isset($_GET["ok"])): ?>
            <div class="mensaje-exito">
                Inscripción guardada correctamente.
            </div>
        <?php endif; ?>

        <div class="acciones-reporte">
            <a href="index.php" class="btn-link">Nueva inscripción</a>
            <a href="excel.php" class="btn-link">Exportar a Excel</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Identidad</th>
                    <th>Nombre completo</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>País</th>
                    <th>Nacionalidad</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Temas</th>
                    <th>Integridad</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($inscripciones)): ?>
                    <tr>
                        <td colspan="11">No hay inscripciones registradas.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($inscripciones as $item): ?>
                    <?php
                        $valido = Integridad::verificar($item, $item["firma"]);
                    ?>

                    <tr>
                        <td><?php echo htmlspecialchars($item["id"]); ?></td>
                        <td><?php echo htmlspecialchars($item["identidad"]); ?></td>
                        <td><?php echo htmlspecialchars($item["nombre"] . " " . $item["apellido"]); ?></td>
                        <td><?php echo htmlspecialchars($item["edad"]); ?></td>
                        <td><?php echo htmlspecialchars($item["sexo"]); ?></td>
                        <td><?php echo htmlspecialchars($item["pais"]); ?></td>
                        <td><?php echo htmlspecialchars($item["nacionalidad"]); ?></td>
                        <td><?php echo htmlspecialchars($item["celular"]); ?></td>
                        <td><?php echo htmlspecialchars($item["email"]); ?></td>
                        <td><?php echo htmlspecialchars($item["temas_texto"] ?? ""); ?></td>
                        <td>
                            <?php if ($valido): ?>
                                <span class="badge verde">Validado</span>
                            <?php else: ?>
                                <span class="badge rojo">Corrupto</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> ITECH Academy. Todos los derechos reservados.</p>
        <p>Contacto: info@itechacademy.com | Tel: +507 6000-0000</p>
    </footer>

</body>
</html>