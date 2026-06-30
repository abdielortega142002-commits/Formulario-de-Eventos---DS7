# Laboratorio: Formulario de Eventos ITECH

Este proyecto consiste en un formulario web de inscripción para un evento tecnológico. El sistema permite registrar participantes, guardar la información en una base de datos MySQL, visualizar un reporte de inscripciones y exportar los datos a Excel.

## Objetivo del laboratorio

Desarrollar una aplicación web utilizando PHP, MySQL, HTML, CSS y JavaScript, aplicando una estructura organizada por capas, validación de datos, sanitización, conexión mediante PDO y generación de reportes.

## Tecnologías utilizadas

- HTML5
- CSS3
- JavaScript
- PHP
- MySQL
- phpMyAdmin
- PDO para conexión segura a la base de datos
- XAMPP o WAMP como servidor local

## Estructura del proyecto

```text
FORMULARIO DE EVENTOS/
│
├── app/
│   └── config/
│       ├── config.php
│       └── Database.php
│
├── controllers/
│   └── InscripcionController.php
│
├── models/
│   └── Inscripcion.php
│
├── service/
│   ├── Sanitizador.php
│   ├── Validador.php
│   └── Integridad.php
│
├── database/
│   └── schema.sql
│
└── public/
    ├── index.php
    ├── guardar.php
    ├── reporte.php
    ├── exportar_excel.php
    │
    └── assets/
        ├── css/
        │   └── styles.css
        └── js/
            └── form.js
```

## Descripción de carpetas y archivos

### `app/config/config.php`

Contiene las constantes de conexión a la base de datos.

```php
define("DB_HOST", "127.0.0.1");
define("DB_NAME", "parcial_itech");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_PORT", "3306");
```

### `app/config/Database.php`

Contiene la clase `Database`, encargada de crear la conexión con MySQL utilizando PDO.

### `controllers/InscripcionController.php`

Controlador principal del sistema. Recibe los datos enviados desde el formulario, ejecuta validaciones, limpia la información y llama al modelo para guardar los registros.

### `models/Inscripcion.php`

Modelo encargado de interactuar con la base de datos. Contiene los métodos para guardar inscripciones y listar los datos en el reporte.

### `service/Sanitizador.php`

Clase de apoyo que limpia los datos ingresados por el usuario. También convierte nombre y apellido al formato título.

### `service/Validador.php`

Clase que valida los campos obligatorios del formulario, como identidad, nombre, apellido, edad, sexo, país, nacionalidad, celular, correo y temas tecnológicos.

### `service/Integridad.php`

Clase que genera y verifica una firma de integridad para los datos registrados. Esto permite identificar si un registro fue modificado directamente en la base de datos.

### `public/index.php`

Formulario principal de inscripción. Contiene los campos solicitados para registrar a un participante.

### `public/guardar.php`

Archivo que recibe los datos del formulario por método POST y llama al controlador para procesar la inscripción.

### `public/reporte.php`

Muestra el listado de inscripciones guardadas en la base de datos, incluyendo el estado de integridad de cada registro.

### `public/exportar_excel.php`

Genera un archivo `.xls` con la información del reporte.

### `public/assets/css/styles.css`

Archivo de estilos del sistema. Define colores, diseño del formulario, botones, tabla, mensajes y footer.

### `public/assets/js/form.js`

Archivo JavaScript que valida en el navegador que se seleccione al menos un tema tecnológico y que la edad y el correo sean válidos.

## Base de datos

La base de datos utilizada se llama:

```text
parcial_itech
```

Tablas principales:

```text
inscripciones
temas
inscripcion_temas
```

### Tabla `inscripciones`

Guarda los datos principales del participante:

- id
- identidad
- nombre
- apellido
- edad
- sexo
- pais
- nacionalidad
- celular
- email
- observaciones
- firma
- fecha_registro

### Tabla `temas`

Guarda los temas tecnológicos disponibles:

- Cloud Computing
- Big Data
- Desarrollo Móvil
- Ciberseguridad
- IoT
- Machine Learning
- DevOps
- Python

### Tabla `inscripcion_temas`

Relaciona cada inscripción con los temas seleccionados por el participante.

## Instalación del proyecto

1. Copiar la carpeta del proyecto dentro de `htdocs` si se usa XAMPP:

```text
C:\xampp\htdocs\Formulario de Eventos
```

2. Iniciar Apache y MySQL desde XAMPP o WAMP.

3. Entrar a phpMyAdmin.

4. Crear la base de datos:

```sql
CREATE DATABASE parcial_itech;
```

5. Ejecutar el archivo SQL ubicado en:

```text
database/schema.sql
```

6. Verificar que en la base de datos existan las tablas:

```text
inscripciones
temas
inscripcion_temas
```

7. Abrir el sistema en el navegador:

```text
http://127.0.0.1/Formulario%20de%20Eventos/public/
```

## Funcionamiento del sistema

### Registro de inscripción

El usuario llena el formulario con los siguientes datos:

- Identidad
- Nombre
- Apellido
- Edad
- Sexo
- País de residencia
- Nacionalidad
- Celular
- Correo electrónico
- Temas tecnológicos de interés
- Observaciones

Al enviar el formulario, los datos pasan por validación y sanitización antes de guardarse en la base de datos.

### Reporte de inscripciones

Después de guardar una inscripción, el sistema redirige al reporte:

```text
public/reporte.php
```

En esta pantalla se muestra una tabla con los participantes registrados y los temas seleccionados separados por coma.

### Exportación a Excel

Desde el reporte se puede presionar el botón:

```text
Exportar a Excel
```

Esto descarga un archivo llamado:

```text
reporte_inscripciones.xls
```

El archivo puede abrirse con Microsoft Excel. Si Excel muestra un aviso indicando que el formato y la extensión no coinciden, se debe seleccionar “Sí” para abrirlo.

## Validaciones aplicadas

El sistema valida:

- Que la identidad no esté vacía.
- Que el nombre y apellido sean obligatorios.
- Que la edad sea válida.
- Que se seleccione un sexo.
- Que el país y la nacionalidad sean obligatorios.
- Que el celular no esté vacío.
- Que el correo tenga formato válido.
- Que se seleccione al menos un tema tecnológico.

## Sanitización de datos

Antes de guardar, los datos se limpian para evitar espacios innecesarios y caracteres problemáticos. Además, el nombre y apellido se guardan en formato título.

Ejemplo:

```text
abdiel ortega
```

se guarda como:

```text
Abdiel Ortega
```

## Integridad de datos

Cada registro se guarda con una firma generada a partir de sus datos principales. En el reporte se muestra un indicador visual:

- Verde: Validado
- Rojo: Corrupto

Esto permite detectar si los datos fueron alterados directamente en la base de datos.

## Configuración de conexión

La conexión está configurada para una instalación local sin contraseña en MySQL:

```php
define("DB_HOST", "127.0.0.1");
define("DB_NAME", "parcial_itech");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_PORT", "3306");
```

Si MySQL utiliza otro puerto, se debe cambiar el valor de `DB_PORT`.

## Errores comunes

### Error: Access denied for user 'root'@'localhost'

Significa que los datos de usuario o contraseña no coinciden con MySQL. En este proyecto se usa:

```text
Usuario: root
Contraseña: vacía
```

### Error: Table doesn't exist

Significa que no se ejecutó correctamente el archivo `schema.sql` o que la base de datos configurada no es la correcta.

### Error: No se puede establecer conexión

Puede significar que MySQL está apagado o que el puerto configurado es incorrecto.

## Recomendaciones

- No abrir el proyecto con Live Server, porque Live Server no ejecuta PHP.
- Ejecutar el proyecto desde Apache usando `localhost` o `127.0.0.1`.
- Revisar que Apache y MySQL estén encendidos.
- Verificar que el archivo `config.php` tenga el nombre correcto de la base de datos.
- Mantener separadas las carpetas de configuración, controladores, modelos, servicios y archivos públicos.

## Autor

Proyecto desarrollado como laboratorio práctico de formulario web con PHP, MySQL y estructura organizada por capas.

## Estado del proyecto

Funcionalidades implementadas:

- Registro de participantes.
- Validación de campos.
- Sanitización de datos.
- Guardado en MySQL.
- Relación entre inscripciones y temas tecnológicos.
- Reporte de inscripciones.
- Verificación de integridad.
- Exportación a Excel.
- Footer con año actual e información de contacto.
