function mostrarImagenPersonaje() {
    document.getElementById("imagen-personaje-container")?.remove(); // Eliminar imagen anterior si existe
    let id = this.value;
    let imagen = '<img src="" alt="Imagen del personaje" class="img-fluid rounded" id="imagen-personaje">';
    let p = document.createElement('p');
    p.id = "imagen-personaje-container";

    fetch(`/api/personaje/${id}/imagen`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }
            this.before(p);
            p.innerHTML = imagen;
            document.getElementById("imagen-personaje").src = "/assets/personajes/" + data.imagen;
    });
}

function mostrarImagenArma() {
    document.getElementById("imagen-arma-container")?.remove(); // Eliminar imagen anterior si existe
    let id = this.value;
    let imagen = '<img src="" alt="Imagen del arma" class="img-fluid rounded" id="imagen-arma">';
    let p = document.createElement('p');
    p.id = "imagen-arma-container";

    fetch(`/api/arma/${id}/imagen`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }
            this.before(p);
            p.innerHTML = imagen;
            document.getElementById("imagen-arma").src = "/assets/armas/" + data.imagen;
    });
}

function mostrarImagenArtefacto() {
    // Busamos si ya hay una imagen previa en este modal y la borramos
    let previewAntigua = this.parentNode.querySelector('.img-preview-artefacto');
    if (previewAntigua) previewAntigua.remove();

    let id = this.value;
    if (!id) return; // Si selecciona "Vacío", no hacemos nada

    // Creamos el contenedor para la imagen del modal
    let div = document.createElement('div');
    div.className = "img-preview-artefacto";
    div.style.marginBottom = "10px";
    div.style.textAlign = "center";
    
    // Placeholder mientras carga
    div.innerHTML = '<img src="" class="img-fluid rounded" style="max-height: 100px;">';
    
    // Lo insertamos antes del select
    this.before(div);

    let set = this.dataset.artefacto; // "flor", "pluma", etc.
    let imgTagModal = div.querySelector('img');

    fetch(`/api/artefacto/${id}/set/${set}/imagen`)
        .then(response => response.json())
        .then(data => {
            if (data.error) { 
                div.remove(); 
                return; 
            }

            // 1. Ponemos la imagen en el MODAL
            let rutaImagen = "/assets/artefactos/" + data.imagen;
            imgTagModal.src = rutaImagen;

            // 2. Ponemos la imagen en el BOTÓN PRINCIPAL (Fuera del modal)
            actualizarBotonPrincipal(set, rutaImagen);
        })
        .catch(err => {
            console.error(err);
            div.remove();
        });
}

// Función auxiliar para pintar el botón de fuera
function actualizarBotonPrincipal(tipo, srcImagen) {
    let boton = document.querySelector(`.btn-modal-artefactos[data-artefacto="${tipo}"]`);
    
    if (boton) {
        boton.textContent = ""; 
        
        // Creamos la imagen pequeña
        let img = document.createElement("img");
        img.src = srcImagen;
        img.className = "img-artefacto";
        img.style.maxHeight = "50px";
        
        boton.appendChild(img);
    }
}

function cargarHabilidades() {
    let container = document.getElementById('habilidades-container');
    
    let idPersonaje = this.value;

    // Limpieza si no hay selección
    if (!idPersonaje) {
        container.innerHTML = '';
        return;
    }

    let esCambioManual = (event && event.type === 'change');
    let hayDatosTwig = container.querySelectorAll('input, select').length > 0;

    if (!esCambioManual && hayDatosTwig) {
        return;
    }

    // MODO CREACIÓN / CAMBIO
    container.innerHTML = '<p class="text-muted">Cargando habilidades...</p>';

    fetch('/api/personaje/' + idPersonaje + '/habilidades') 
        .then(res => res.json())
        .then(data => {
            container.innerHTML = ''; // Limpiar mensaje de carga
            
            let prototype = container.dataset.prototype;
            
            if (!data || data.length === 0) {
                container.innerHTML = '<p>No hay habilidades disponibles.</p>';
                return;
            }

            data.forEach((habilidadInfo, index) => {
                let formHtml = prototype.replace(/__name__/g, index);
                
                let divWrapper = document.createElement('div');
                divWrapper.className = "grupo-habilidad"; 
                divWrapper.style.marginBottom = "10px";
                divWrapper.innerHTML = formHtml;

                let labelNombre = document.createElement('label');
                labelNombre.textContent = habilidadInfo.nombre;
                labelNombre.style.display = "block";
                labelNombre.style.marginBottom = "5px";
                labelNombre.style.color = "#ffffff";
                
                divWrapper.prepend(labelNombre);

                let selectOculto = divWrapper.querySelector('select');
                if (selectOculto) {
                    let option = document.createElement('option');
                    option.value = habilidadInfo.id;
                    option.text = habilidadInfo.nombre;
                    option.selected = true;
                    selectOculto.appendChild(option);
                }

                container.appendChild(divWrapper);
            });
        })
        .catch(err => {
            console.error(err);
            container.innerHTML = '<p class="text-danger">Error al cargar habilidades.</p>';
        });
}

function abrirModal() {
    let tipo = this.getAttribute("data-artefacto"); // Obtenemos el tipo de artefacto (flor, pluma, etc.)
    let modal = document.getElementById("modal-" + tipo); // Buscamos el modal correspondiente
    if (modal) {
        modal.classList.add("active"); // Mostramos el modal
    }
}

function cerrarModal(boton, i) {
    let modal = boton.closest(".modal-artefacto-overlay"); // Buscamos el modal padre más cercano
    if (modal) {
        modal.classList.remove("active"); // Ocultamos el modal
    }

    if (boton.classList.contains("btn-guardar-modal")) {
        let select = document.getElementsByClassName("artefacto-set-select")[i];

        let tipo = modal.id.replace("modal-", ""); // Obtenemos el tipo de artefacto del id del modal
        let botonModal = document.querySelector(`.btn-modal-artefactos[data-artefacto="${tipo}"]`);

        if (select.value !== "") {
            botonModal.textContent = ""; // Limpiamos el texto del botón para añadir la imagen

            let img = document.createElement("img");
            img.setAttribute("src", "");
            img.classList.add("img-artefacto");
            botonModal.appendChild(img); // Añadimos la imagen al botón del artefacto

            botonModal.querySelector("img").src = document.getElementById("imagen-artefacto").src; // Actualizamos la imagen del botón con la del artefacto seleccionado
        } else {
            botonModal.textContent = "+ Añadir " + tipo.charAt(0).toUpperCase() + tipo.slice(1); // Restauramos el texto del botón si no se ha seleccionado ningún artefacto
        }
    }
}

// Cerrar modal al hacer clic fuera del contenido
window.addEventListener('click', function(event) {
    if (event.target.classList.contains('modal-artefacto-overlay')) {
        event.target.classList.remove('active');
    }
});


// =========================================
// Asignaciones
// =========================================
window.onload = function() {

    let personajeSelector = document.getElementsByClassName("personaje-selector")[0];
    let armaSelector = document.getElementsByClassName("arma-selector")[0];

    personajeSelector.onchange = function() {
        mostrarImagenPersonaje.call(this);
        cargarHabilidades.call(this);
    };
    armaSelector.onchange = mostrarImagenArma;

    // Cargar imagen al inicio si ya hay valor
    if (personajeSelector.value) {
        mostrarImagenPersonaje.call(personajeSelector);
        
        cargarHabilidades.call(personajeSelector); 
    }
    if (armaSelector.value) {
        mostrarImagenArma.call(armaSelector);
    }

    let artefactoSelects = document.getElementsByClassName("artefacto-set-select");
    Array.from(artefactoSelects).forEach(select => {
        select.onchange = mostrarImagenArtefacto;

        if (select.value) {
            mostrarImagenArtefacto.call(select);
        }
    });

    let botonModal = document.getElementsByClassName("btn-modal-artefactos");
    for (let i = 0; i < botonModal.length; i++) {
        botonModal[i].onclick = abrirModal;
    }

    let botonesCerrar = document.getElementsByClassName("btn-cerrar-modal");
    for (let i = 0; i < botonesCerrar.length; i++) {
        botonesCerrar[i].onclick = function() { cerrarModal(this, i); };
    }

    let botonesGuardar = document.getElementsByClassName("btn-guardar-modal");
    for (let i = 0; i < botonesGuardar.length; i++) {
        botonesGuardar[i].onclick = function() { cerrarModal(this, i); };
    }

}