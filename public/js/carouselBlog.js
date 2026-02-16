document.addEventListener('DOMContentLoaded', () => {
    let showingPosts = true; //variable que controla en que pantalla estamos

    const postsSection = document.getElementById('section-posts');
    const buildsSection = document.getElementById('section-builds');
    const title = document.getElementById('carousel-title');
    const carouselButtons = document.querySelectorAll('.carousel-btn');

    function toggleSection() {
        showingPosts = !showingPosts; // Cambiamos el estado

        if (showingPosts) {
            //mostrar Posts ocultar Builds
            postsSection.classList.add('active');
            buildsSection.classList.remove('active');
            title.innerText = "Publicaciones";
        } else {
            //mostrar Builds ocultar Posts
            buildsSection.classList.add('active');
            postsSection.classList.remove('active');
            title.innerText = "Builds de la Comunidad";
        }
    }

    //evento de clic a todas las flechas (botones)
    carouselButtons.forEach(button => {
        button.addEventListener('click', toggleSection);
    });
});