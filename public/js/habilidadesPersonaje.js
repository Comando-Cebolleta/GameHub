document.addEventListener('DOMContentLoaded', function () {
    const personajeSelect = document.querySelector('.personaje-selector');
    const container = document.getElementById('habilidades-container');

    if (!personajeSelect || !container) return;

    // Obtenemos el prototipo del data-prototype
    // El prototipo contiene el HTML de un subformulario nuevo (PersonajeHabilidadType)
    // __name__ es el placeholder que Symfony usa para el índice
    const prototype = container.dataset.prototype;

    personajeSelect.addEventListener('change', function () {
        const personajeId = this.value;

        // Limpiamos el contenedor
        container.innerHTML = '';
        container.innerHTML = '<p class="text-muted">Cargando habilidades...</p>';

        if (!personajeId) {
            container.innerHTML = '';
            return;
        }

        fetch(`/api/personaje/${personajeId}/habilidades`)
            .then(response => response.json())
            .then(data => {
                container.innerHTML = ''; // Limpiar mensaje de carga

                if (data.error) {
                    console.error(data.error);
                    return;
                }

                if (data.length === 0) {
                    container.innerHTML = '<p class="text-muted">Este personaje no tiene habilidades registradas.</p>';
                    return;
                }

                data.forEach((habilidad, index) => {
                    // Reemplazamos __name__ por el índice actual
                    let newFormHtml = prototype.replace(/__name__/g, index);

                    // Creamos un elemento temporal para manipular el HTML
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = newFormHtml;

                    // Buscamos el select de habilidad (que está oculto) y le asignamos el valor
                    const selectHabilidad = tempDiv.querySelector('select');
                    if (selectHabilidad) {
                        selectHabilidad.value = habilidad.id;
                    }

                    // Buscamos el input de nivel para ponerle un label bonito
                    const inputNivel = tempDiv.querySelector('input[type="number"]');

                    // Creamos una estructura visual bonita
                    const rowDiv = document.createElement('div');
                    rowDiv.className = 'mb-3 d-flex align-items-center justify-content-between p-2 border rounded';
                    rowDiv.style.backgroundColor = 'rgba(255, 255, 255, 0.05)';

                    const labelNombre = document.createElement('label');
                    labelNombre.textContent = habilidad.nombre;
                    labelNombre.className = 'fw-bold text-light mb-0';
                    labelNombre.style.flex = '1';

                    // Wrapper para el input
                    const inputWrapper = document.createElement('div');
                    inputWrapper.style.width = '100px';
                    inputWrapper.appendChild(inputNivel);

                    // Insertamos el select oculto
                    rowDiv.appendChild(selectHabilidad);
                    rowDiv.appendChild(labelNombre);
                    rowDiv.appendChild(inputWrapper);

                    container.appendChild(rowDiv);
                });
            })
            .catch(error => {
                console.error('Error fetching habilidades:', error);
                container.innerHTML = '<p class="text-danger">Error al cargar habilidades.</p>';
            });
    });
});
