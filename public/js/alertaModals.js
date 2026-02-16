document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-build-genshin");
    
    if (!form) return;

    if (form.getAttribute("data-js-preparado") === "true") {
        console.log("El script ya estaba cargado. Evitando ejecución doble.");
        return; 
    }
    form.setAttribute("data-js-preparado", "true");

    const inputsOcultos = form.querySelectorAll(".modal-artefacto-content [required]");
    
    // Les quitamos el atributo 'required' para que el navegador no se queje,
    // pero les ponemos una marca nuestra 'data-check-me' para revisarlos nosotros.
    inputsOcultos.forEach(input => {
        input.removeAttribute("required");
        input.setAttribute("data-check-me", "true");
    });


    form.addEventListener("submit", (e) => {
        // Buscamos campos vacíos que tengan nuestra marca
        const inputsArtefactos = form.querySelectorAll("[data-check-me='true']");
        
        let errorEncontrado = false;
        let modalParaAbrir = null;

        // Revisamos uno por uno
        for (let i = 0; i < inputsArtefactos.length; i++) {
            if (!inputsArtefactos[i].value.trim()) {
                errorEncontrado = true;
                // Guardamos el modal padre
                modalParaAbrir = inputsArtefactos[i].closest(".modal-artefacto-overlay");
                break;
            }
        }

        // Si encontramos un error en los artefactos...
        if (errorEncontrado) {
            e.preventDefault();           // Frena el envío
            e.stopImmediatePropagation(); // Frena cualquier otro script que intente saltar
            
            if (modalParaAbrir) {
                modalParaAbrir.classList.add("active");
            }

            alert("Error: Faltan datos en los Artefactos. Revisa la ventana abierta.");
        }
    });
});