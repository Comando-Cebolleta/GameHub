document.addEventListener('DOMContentLoaded', function() {
    // Buscamos todos los contenedores de artefactos.
    // Como Symfony genera IDs anidados, buscamos por estructura.
    // Asumimos que cada artefacto está agrupado visualmente en un div o 
    // podemos detectar los grupos de selects navegando el DOM.
    
    // Buscar todos los selects de Main Stat y encontrar sus hermanos Substats.
    const mainStatSelects = document.querySelectorAll('.main-stat-select');

    mainStatSelects.forEach(mainSelect => {
        // Encontrar el contenedor padre (el div que envuelve Flor, Pluma, etc)
        
        const baseId = mainSelect.id.replace('_statPrincipalNombre', '');
        
        const subSelects = [];
        for (let i = 1; i <= 4; i++) {
            const sub = document.getElementById(baseId + '_subStatNombre' + i);
            if (sub) subSelects.push(sub);
        }

        // Función para actualizar disponibilidades
        function updateOptions() {
            const selectedValues = [];
            
            // 1. Obtener valor del Main Stat
            const mainValue = mainSelect.value;
            if (mainValue) selectedValues.push(mainValue);

            // 2. Obtener valores de los Substats YA seleccionados
            subSelects.forEach(sel => {
                if (sel.value) selectedValues.push(sel.value);
            });

            // 3. Iterar sobre los Substats para deshabilitar opciones
            subSelects.forEach(currentSelect => {
                const currentValue = currentSelect.value;
                
                // Recorrer todas las opciones de este select
                Array.from(currentSelect.options).forEach(option => {
                    // Si la opción no tiene valor (placeholder), saltar
                    if (!option.value) return;

                    // Lógica de bloqueo:
                    // Bloquear si el valor está en selectedValues Y NO es el valor que este mismo select tiene seleccionado actualmente
                    if (selectedValues.includes(option.value) && option.value !== currentValue) {
                        option.disabled = true;
                        // Visualmente oculto para navegadores modernos
                        option.style.display = 'none'; 
                    } else {
                        option.disabled = false;
                        option.style.display = 'block';
                    }
                });
            });
        }

        // Agregar Event Listeners
        mainSelect.addEventListener('change', updateOptions);
        subSelects.forEach(sub => {
            sub.addEventListener('change', updateOptions);
        });

        updateOptions();
    });
});