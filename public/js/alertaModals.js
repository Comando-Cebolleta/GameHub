document.addEventListener("DOMContentLoaded", () => {

    // Buscamos el formulario de Genshin o el de HSR
    const form =
        document.getElementById("form-build-genshin") ||
        document.getElementById("form-build-hsr");

    // Si no hay formulario, no hacemos nada
    if (!form) return;

    // Evitamos que el script se ejecute dos veces sobre el mismo formulario
    if (form.dataset.jsPreparado === "true") return;

    // Marcamos el formulario como ya preparado
    form.dataset.jsPreparado = "true";

    const inputsOcultos = form.querySelectorAll(".modal-artefacto-content [required]");

    inputsOcultos.forEach(input => {
        // Quitamos el 'required' nativo del navegador
        // (porque al estar en modales ocultos bloquearía el submit)
        input.removeAttribute("required");

        // Añadimos una marca personalizada para validarlos manualmente después
        input.dataset.checkMe = "true";
    });

    form.addEventListener("submit", (e) => {

        // Seleccionamos todos los campos que deben validarse manualmente
        const inputs = form.querySelectorAll("[data-check-me='true']");

        for (const input of inputs) {

            // Si el campo está vacío (tras quitar espacios)
            if (!input.value.trim()) {

                // Bloqueamos el envío del formulario
                e.preventDefault();

                // Evitamos que otros listeners intenten enviarlo igualmente
                e.stopImmediatePropagation();

                // Buscamos el modal padre de ese input vacío
                const modal = input.closest(".modal-artefacto-overlay");

                // Si existe, lo abrimos para que el usuario vea el error
                if (modal) modal.classList.add("active");

                alert("Error: Faltan datos en las piezas del equipo.");

                return;
            }
        }
    });
});
