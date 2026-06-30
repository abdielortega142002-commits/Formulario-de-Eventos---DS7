<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Inscripción</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <main class="contenedor">
        <h1>Formulario de Inscripción</h1>
        <p class="subtitulo">Evento Tecnológico ITECH</p>

        <form action="guardar.php" method="POST" id="formInscripcion">

            <div class="campo">
                <label for="identidad">Identidad:</label>
                <input type="text" id="identidad" name="identidad" required>
            </div>

            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="campo">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>

            <div class="campo">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" min="1" max="120" required>
            </div>

            <div class="campo">
                <label>Sexo:</label>

                <div class="opciones-linea">
                    <label>
                        <input type="radio" name="sexo" value="Masculino" required>
                        Masculino
                    </label>

                    <label>
                        <input type="radio" name="sexo" value="Femenino" required>
                        Femenino
                    </label>
                </div>
            </div>

            <div class="campo">
                <label for="pais">País de residencia:</label>
                <input type="text" id="pais" name="pais" required>
            </div>

            <div class="campo">
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="text" id="nacionalidad" name="nacionalidad" required>
            </div>

            <div class="campo">
                <label for="celular">Celular:</label>
                <input type="text" id="celular" name="celular" required>
            </div>

            <div class="campo">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="campo">
                <label>Temas tecnológicos de interés:</label>

                <div class="checkbox-grid">
                    <label>
                        <input type="checkbox" name="temas[]" value="Cloud Computing">
                        Cloud Computing
                    </label>

                    <label>
                        <input type="checkbox" name="temas[]" value="Big Data">
                        Big Data
                    </label>

                    <label>
                        <input type="checkbox" name="temas[]" value="Desarrollo Móvil">
                        Desarrollo Móvil
                    </label>

                    <label>
                        <input type="checkbox" name="temas[]" value="Ciberseguridad">
                        Ciberseguridad
                    </label>

                    <label>
                        <input type="checkbox" name="temas[]" value="IoT">
                        IoT
                    </label>

                    <label>
                        <input type="checkbox" name="temas[]" value="Machine Learning">
                        Machine Learning
                    </label>

                    <label>
                        <input type="checkbox" name="temas[]" value="DevOps">
                        DevOps
                    </label>

                    <label>
                        <input type="checkbox" name="temas[]" value="Python">
                        Python
                    </label>
                </div>
            </div>

            <div class="campo">
                <label for="observaciones">Observaciones:</label>
                <textarea id="observaciones" name="observaciones" rows="4"></textarea>
            </div>

            <div class="acciones">
                <button type="submit">Enviar inscripción</button>
                <button type="reset" class="btn-secundario">Limpiar</button>
                <a href="reporte.php" class="btn-link">Ver reporte</a>
            </div>

        </form>
    </main>

    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> ITECH Academy. Todos los derechos reservados.</p>
        <p>Contacto: info@itechacademy.com | Tel: +507 6000-0000</p>
    </footer>

    <script src="assets/js/form.js"></script>
</body>
</html>