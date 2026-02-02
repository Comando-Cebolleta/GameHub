document.addEventListener('DOMContentLoaded', function() {
    // 1. Seleccionamos los elementos por una clase específica que añadiremos en el FormType
    const personajeSelect = document.querySelector('.personaje-selector');
    const armaSelect = document.querySelector('.arma-selector');

    // Validación de seguridad: si no existen los elementos en esta página, no hacemos nada
    if (!personajeSelect || !armaSelect) return;

    // 2. Guardamos TODAS las opciones originales del select de armas en memoria.
    // Usamos Array.from para crear una copia estática, ya que .options es una lista viva.
    const todasLasArmas = Array.from(armaSelect.options);

    // 3. Función principal de filtrado
    function filtrarArmas() {
        const opcionSeleccionada = personajeSelect.options[personajeSelect.selectedIndex];
        
        // Obtenemos el tipo de arma que requiere el personaje (ej: "Espada")
        // dataset.tipoArma equivale a leer el atributo data-tipo-arma
        const tipoRequerido = opcionSeleccionada.dataset.tipoArma;

        // Guardamos el valor que tenía el arma seleccionada antes de limpiar (si había)
        const valorArmaPrevia = armaSelect.value;

        // Limpiamos el select actual
        armaSelect.innerHTML = '';

        // Recorremos la copia de seguridad y añadimos solo las que coinciden
        todasLasArmas.forEach(opcion => {
            const tipoArma = opcion.dataset.tipo;
            
            // Condiciones para mostrar la opción:
            // A. Es el placeholder (valor vacío)
            // B. El personaje no tiene tipo definido (caso raro, mostramos todo)
            // C. El tipo del arma coincide con el del personaje
            if (opcion.value === "" || !tipoRequerido || tipoArma === tipoRequerido) {
                // Clonamos el nodo para no perder la referencia original en 'todasLasArmas'
                armaSelect.appendChild(opcion.cloneNode(true));
            }
        });

        // Intentamos restaurar la selección anterior si sigue siendo válida
        // Si no, el navegador seleccionará por defecto la primera opción (placeholder)
        armaSelect.value = valorArmaPrevia;
        
        // Si el valor previo ya no existe en la lista filtrada, reseteamos a vacío
        if (armaSelect.selectedIndex === -1) {
            armaSelect.value = "";
        }
    }

    // 4. Event Listeners
    // Ejecutar cuando el usuario cambia el personaje
    personajeSelect.addEventListener('change', filtrarArmas);

    // Ejecutar al cargar la página (para manejar validaciones fallidas o modo edición)
    // Solo filtramos si ya hay un personaje seleccionado
    if (personajeSelect.value) {
        filtrarArmas();
    }
});