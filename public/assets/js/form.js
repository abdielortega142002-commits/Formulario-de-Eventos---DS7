document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formInscripcion");

    if (!form) {
        return;
    }

    form.addEventListener("submit", function (e) {
        const temasSeleccionados = document.querySelectorAll('input[name="temas[]"]:checked');

        if (temasSeleccionados.length === 0) {
            e.preventDefault();
            alert("Debe seleccionar al menos un tema tecnológico.");
            return;
        }

        const edad = document.getElementById("edad").value;

        if (edad <= 0 || edad > 120) {
            e.preventDefault();
            alert("Debe ingresar una edad válida.");
            return;
        }

        const email = document.getElementById("email").value.trim();

        if (!email.includes("@")) {
            e.preventDefault();
            alert("Debe ingresar un correo electrónico válido.");
            return;
        }
    });
});