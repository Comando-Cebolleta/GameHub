document.addEventListener('DOMContentLoaded', function() {
    // Obtener elementos
    const btnAbrirModal = document.getElementById('btn-arma-modal');
    const modalArmas = document.getElementById('modal-armas');
    const gridArmas = document.getElementById('grid-armas');
    const btnCerrarModal = document.querySelector('.btn-cerrar-modal-armas');
    const btnLimpiar = document.getElementById('btn-limpiar-arma');
    const selectArma = document.querySelector('.arma-selector');
    const selectPersonaje = document.querySelector('.personaje-selector');
    
    // Si no existen los elementos necesarios, salir
    if (!btnAbrirModal || !modalArmas || !selectArma) return;

    // NO almacenamos todasLasArmas globalmente, la cargamos cada vez que se abre el modal
    // Esto evita el bug donde las armas no se actualizan cuando cambia el personaje

    // Función para cargar armas disponibles (filtradas por personaje)
    function cargarArmas() {
        // Obtener el tipo de arma requerido del personaje seleccionado
        let tipoRequerido = null;
        if (selectPersonaje && selectPersonaje.value) {
            const opcionPersonaje = selectPersonaje.options[selectPersonaje.selectedIndex];
            tipoRequerido = opcionPersonaje.dataset.tipoArma;
        }

        gridArmas.innerHTML = '';
        
        // Extraer todas las opciones del select actualizado
        const opciones = Array.from(selectArma.options);
        let todasLasArmas = [];
        
        opciones.forEach(opcion => {
            if (opcion.value !== '') {  // Omitir el placeholder
                todasLasArmas.push({
                    id: opcion.value,
                    nombre: opcion.text,
                    tipo: opcion.dataset.tipo || null
                });
            }
        });
        
        // Filtrar armas según tipo requerido
        let armasFiltradasActuales = todasLasArmas;
        if (tipoRequerido) {
            armasFiltradasActuales = todasLasArmas.filter(arma => arma.tipo === tipoRequerido);
        }

        if (!armasFiltradasActuales || armasFiltradasActuales.length === 0) {
            gridArmas.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: #999;">No hay armas disponibles</p>';
            return;
        }

        // Crear tarjetas de armas
        armasFiltradasActuales.forEach(arma => {
            const card = document.createElement('div');
            card.className = 'arma-card';
            card.dataset.armaId = arma.id;
            
            // Crear imagen
            const img = document.createElement('img');
            img.alt = arma.nombre;
            img.src = '';
            img.dataset.armaId = arma.id;
            
            // Cargar imagen desde API
            fetch(`/api/arma/${arma.id}/imagen`)
                .then(response => response.json())
                .then(imagenData => {
                    if (!imagenData.error) {
                        img.src = '/assets/armas/' + imagenData.imagen;
                    }
                })
                .catch(err => console.error('Error cargando imagen de arma:', err));
            
            // Crear nombre
            const nombre = document.createElement('div');
            nombre.className = 'arma-card-nombre';
            nombre.textContent = arma.nombre;
            
            // Agregar elementos a la tarjeta
            card.appendChild(img);
            card.appendChild(nombre);
            
            // Agregar evento click
            card.addEventListener('click', function() {
                seleccionarArma(arma.id, arma.nombre, img.src);
            });
            
            gridArmas.appendChild(card);
        });
    }

    // Función para seleccionar un arma
    function seleccionarArma(id, nombre, imagenUrl) {
        // Actualizar el select oculto
        selectArma.value = id;
        
        // Disparar evento change para que se ejecute cualquier handler
        selectArma.dispatchEvent(new Event('change', { bubbles: true }));
        
        // Actualizar el botón modal con la imagen
        const btnTexto = document.querySelector('.btn-arma-text');
        const btnImagen = document.querySelector('.btn-arma-img');
        
        btnTexto.textContent = nombre;
        btnImagen.src = imagenUrl;
        btnImagen.style.display = 'block';

        // Cerrar el modal
        cerrarModal();
    }

    // Función para limpiar la selección
    function limpiarSeleccion() {
        // Limpiar el select oculto
        selectArma.value = '';
        
        // Disparar evento change para que se ejecute cualquier handler
        selectArma.dispatchEvent(new Event('change', { bubbles: true }));
        
        // Limpiar el botón modal
        const btnTexto = document.querySelector('.btn-arma-text');
        const btnImagen = document.querySelector('.btn-arma-img');
        
        btnTexto.textContent = 'Selecciona arma...';
        btnImagen.style.display = 'none';
        
        // Limpiar imagen de fetch
        const containerArma = document.getElementById("imagen-arma-container");
        if (containerArma) containerArma.innerHTML = '';
        
        // Cerrar el modal
        cerrarModal();
    }

    // Función para abrir el modal
    function abrirModalArmas() {
        modalArmas.classList.add('active');
        // Cargar armas SIEMPRE, para que se actualicen si cambió el personaje
        cargarArmas();
    }

    // Función para cerrar el modal
    function cerrarModal() {
        modalArmas.classList.remove('active');
    }

    // Event listeners
    btnAbrirModal.addEventListener('click', function(e) {
        e.preventDefault();
        abrirModalArmas();
    });

    if (btnCerrarModal) {
        btnCerrarModal.addEventListener('click', cerrarModal);
    }

    if (btnLimpiar) {
        btnLimpiar.addEventListener('click', function(e) {
            e.preventDefault();
            limpiarSeleccion();
        });
    }

    // Cerrar modal al hacer click fuera del contenido
    modalArmas.addEventListener('click', function(event) {
        if (event.target === modalArmas) {
            cerrarModal();
        }
    });

    // Cargar armas al inicio si ya hay seleccionada
    if (selectArma.value) {
        // Obtener el nombre del arma seleccionada
        const opcionSeleccionada = selectArma.options[selectArma.selectedIndex];
        const nombreArma = opcionSeleccionada.text;
        const idArma = selectArma.value;
        
        // Cargar la imagen
        fetch(`/api/arma/${idArma}/imagen`)
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    const btnTexto = document.querySelector('.btn-arma-text');
                    const btnImagen = document.querySelector('.btn-arma-img');
                    
                    btnTexto.textContent = nombreArma;
                    btnImagen.src = '/assets/armas/' + data.imagen;
                    btnImagen.style.display = 'block';
                }
            });
    }
});
