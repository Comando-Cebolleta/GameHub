// Controladores activos de fetch para poder abortarlos si cambian las selecciones
let efectosSetControllers = [];

function actualizarEfectosSet() {    
    // Buscar todos los elementos img con data-idSet
    let artefactos = Array.from(document.getElementsByClassName('img-set-data'))
        .filter(el => el.dataset.idSet);

    // Si no hay artefactos, abortar fetchs pendientes y limpiar UI
    if (artefactos.length === 0) {
        efectosSetControllers.forEach(c => c.abort());
        efectosSetControllers = [];
        let contenedoresP = document.querySelectorAll('p.efecto-container');
        contenedoresP.forEach(el => el.remove());
        return;
    }

    // Contar cuántos artefactos hay por cada conjunto
    let efectosPorSet = {};

    artefactos.forEach(artefacto => {
        let idSet = artefacto.dataset.idSet;

        if (!idSet) return;

        efectosPorSet[idSet] = (efectosPorSet[idSet] || 0) + 1;
    });

    // Abortar fetchs anteriores y limpiar contenedores previos
    efectosSetControllers.forEach(c => c.abort());
    efectosSetControllers = [];
    let contenedoresP = document.querySelectorAll('p.efecto-container');
    contenedoresP.forEach(el => el.remove());

    let targetElement = document.getElementsByClassName("section-subtitle2")[0];
    if (!targetElement) return;

    // Hacer un fetch por cada conjunto distinto
    Object.entries(efectosPorSet).forEach(([idSet, cantidad]) => {
        let p = document.createElement('p');
        p.className = "efecto-container"; // Usar clase en lugar de ID para permitir múltiples elementos

        // Crear un AbortController por cada fetch y almacenar para poder cancelarlo
        const controller = new AbortController();
        efectosSetControllers.push(controller);

        fetch(`/api/set/${idSet}/cantidad/${cantidad}/efectos`, { signal: controller.signal })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error(data.error);
                    return;
                }
                p.innerHTML = Object.entries(data.efectos || {})
                    .map(([piezas, efecto]) => `<strong>${piezas} piezas:</strong> ${efecto}`)
                    .join('<br>');
                targetElement.after(p);
            })
            .catch(err => {
                if (err.name === 'AbortError') {
                    // Fetch abortado intencionalmente: no hacer nada
                    return;
                }
                console.error('Error en fetch efectosSet:', err);
            });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    let selects = document.getElementsByClassName("artefacto-set-select");
    
    for (let i = 0; i < selects.length; i++) {
        selects[i].addEventListener('change', actualizarEfectosSet);
    }
    
});