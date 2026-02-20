document.addEventListener('DOMContentLoaded', function() {
    // Obtener elementos
    const btnAbrirModal = document.getElementById('btn-personaje-modal');
    const modalPersonajes = document.getElementById('modal-personajes');
    const gridPersonajes = document.getElementById('grid-personajes');
    const btnCerrarModal = document.querySelector('.btn-cerrar-modal-personajes');
    const btnLimpiar = document.getElementById('btn-limpiar-personaje');
    const selectPersonaje = document.querySelector('.personaje-selector');
    
    // Si no existen los elementos necesarios, salir
    if (!btnAbrirModal || !modalPersonajes || !selectPersonaje) return;

    // Determinar el juego basado en el ID del formulario
    let juego = 'genshin';
    if (document.getElementById('form-build-hsr')) {
        juego = 'hsr';
    }

    // Función para cargar personajes disponibles
    function cargarPersonajes() {
        fetch(`/api/personajes/${juego}`)
            .then(response => response.json())
            .then(data => {
                gridPersonajes.innerHTML = '';
                
                if (!data || data.length === 0) {
                    gridPersonajes.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: #999;">No hay personajes disponibles</p>';
                    return;
                }

                // Crear tarjetas de personajes
                data.forEach(personaje => {
                    const card = document.createElement('div');
                    card.className = 'personaje-card';
                    card.dataset.personajeId = personaje.id;
                    
                    // Crear imagen
                    const img = document.createElement('img');
                    img.alt = personaje.nombre;
                    img.src = '';
                    img.dataset.personajeId = personaje.id;
                    
                    // Cargar imagen desde API
                    fetch(`/api/personaje/${personaje.id}/imagen`)
                        .then(response => response.json())
                        .then(imagenData => {
                            if (!imagenData.error) {
                                img.src = '/assets/personajes/' + imagenData.imagen;
                            }
                        })
                        .catch(err => console.error('Error cargando imagen de personaje:', err));
                    
                    // Crear nombre
                    const nombre = document.createElement('div');
                    nombre.className = 'personaje-card-nombre';
                    nombre.textContent = personaje.nombre;
                    
                    // Agregar elementos a la tarjeta
                    card.appendChild(img);
                    card.appendChild(nombre);
                    
                    // Agregar evento click
                    card.addEventListener('click', function() {
                        seleccionarPersonaje(personaje.id, personaje.nombre, img.src);
                    });
                    
                    gridPersonajes.appendChild(card);
                });
            })
            .catch(err => {
                console.error('Error cargando personajes:', err);
                gridPersonajes.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: #ff6b6b;">Error al cargar personajes</p>';
            });
    }

    // Función para seleccionar un personaje
    function seleccionarPersonaje(id, nombre, imagenUrl) {
        // Actualizar el select oculto
        selectPersonaje.value = id;
        
        // Disparar evento change para que se ejecute el filtrado de armas
        selectPersonaje.dispatchEvent(new Event('change', { bubbles: true }));
        
        // Actualizar el botón modal con la imagen
        const btnTexto = document.querySelector('.btn-personaje-text');
        const btnImagen = document.querySelector('.btn-personaje-img');
        
        btnTexto.textContent = nombre;
        btnImagen.src = imagenUrl;
        btnImagen.style.display = 'block';

        // Cerrar el modal
        cerrarModal();
    }

    // Función para limpiar la selección
    function limpiarSeleccion() {
        // Limpiar el select oculto
        selectPersonaje.value = '';
        
        // Disparar evento change para limpiar las armas también
        selectPersonaje.dispatchEvent(new Event('change', { bubbles: true }));
        
        // Limpiar el botón modal
        const btnTexto = document.querySelector('.btn-personaje-text');
        const btnImagen = document.querySelector('.btn-personaje-img');
        
        btnTexto.textContent = 'Selecciona personaje...';
        btnImagen.style.display = 'none';
        
        // Limpiar imagen de fetch
        const containerPersonaje = document.getElementById("imagen-personaje-container");
        if (containerPersonaje) containerPersonaje.innerHTML = '';
        
        // Cerrar el modal
        cerrarModal();
    }

    // Función para abrir el modal
    function abrirModalPersonajes() {
        modalPersonajes.classList.add('active');
        // Cargar personajes si no están cargados
        if (gridPersonajes.children.length === 0) {
            cargarPersonajes();
        }
    }

    // Función para cerrar el modal
    function cerrarModal() {
        modalPersonajes.classList.remove('active');
    }

    // Event listeners
    btnAbrirModal.addEventListener('click', function(e) {
        e.preventDefault();
        abrirModalPersonajes();
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
    modalPersonajes.addEventListener('click', function(event) {
        if (event.target === modalPersonajes) {
            cerrarModal();
        }
    });

    // Cargar personajes al inicio si ya hay seleccionado
    if (selectPersonaje.value) {
        // Obtener el nombre del personaje seleccionado
        const opcionSeleccionada = selectPersonaje.options[selectPersonaje.selectedIndex];
        const nombrePersonaje = opcionSeleccionada.text;
        const idPersonaje = selectPersonaje.value;
        
        // Cargar la imagen
        fetch(`/api/personaje/${idPersonaje}/imagen`)
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    const btnTexto = document.querySelector('.btn-personaje-text');
                    const btnImagen = document.querySelector('.btn-personaje-img');
                    
                    btnTexto.textContent = nombrePersonaje;
                    btnImagen.src = '/assets/personajes/' + data.imagen;
                    btnImagen.style.display = 'block';
                }
            });
    }
});

