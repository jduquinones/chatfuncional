(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Date and time picker
    $('.date').datetimepicker({
        format: 'L'
    });
    $('.time').datetimepicker({
        format: 'LT'
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        margin: 30,
        dots: true,
        loop: true,
        center: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });
    
})(jQuery);



// document.getElementById('form-clase').addEventListener('submit', function(e) {
//     e.preventDefault();

//     const nombre = document.getElementById('nombre').value.trim();
//     const fecha = document.getElementById('fecha').value;
//     const hora = document.getElementById('hora').value;
//     const duracion = document.getElementById('duracion').value;
//     const tema = document.getElementById('tema').value;
//     const notas = document.getElementById('notas').value.trim();

//     if (!nombre || !fecha || !hora || !duracion || !tema) {
//         alert('Por favor, complete todos los campos obligatorios.');
//         return;
//     }

//     const lista = document.getElementById('lista-clases');
//     const li = document.createElement('li');
//     li.textContent = `${nombre} - ${tema} el ${fecha} a las ${hora} (${duracion} horas)`;
//     if (notas) li.textContent += ` - Notas: ${notas}`;
//     lista.appendChild(li);

//     document.getElementById('form-clase').reset();
// });

