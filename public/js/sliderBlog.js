$(document).ready(function(){
    //aqui guardamos el carrusel en una variable
    var $carrusel = $('.mi-carrusel');

    // 1. Inicializamos Slick
    $carrusel.slick({
        dots: false,
        autoplay: false,
        infinite: true,
        adaptiveHeight: true,
        arrows: true,
        prevArrow: $('.btn-prev'),
        nextArrow: $('.btn-next')
    });

    //evento para cambiar el título (H1) cuando el carrusel se mueve
    $carrusel.on('afterChange', function(event, slick, currentSlide){
        //currentSlide es 0 para Posts y 1 para Builds
        if (currentSlide === 0) {
            $('#carousel-title').text('Publicaciones');
        } else {
            $('#carousel-title').text('Builds de la Comunidad');
        }
    });
});