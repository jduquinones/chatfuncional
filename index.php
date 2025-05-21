<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ClassOn Virtual</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
 

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include "./inc/header.php" ?>


    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Saber & Explicar </h4>
                            <h1 class="display-3 text-white mb-md-4">Donde Profesores Comparten Su Conocimiento Contigo</h1>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Aprende & Avanza</h4>
                            <h1 class="display-3 text-white mb-md-4">Profesores calificados para ayudarte en lo que necesitas.</h1>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->



    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/about.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Sobre Nosotros</h6>
                        <h1 class="mb-3">Conectamos estudiantes con docentes certificados para asesorías personalizadas.</h1>
                        <p>Nos enfocamos en conectar a estudiantes con docentes certificados que ofrecen asesorías personalizadas y de alta calidad, pensadas para resolver dudas puntuales y fortalecer el aprendizaje.
                            Ya sea que estés preparándote para un examen o necesites comprender mejor un concepto, nuestros profesionales aliados están aquí para ayudarte a alcanzar tus objetivos de manera eficiente, accesible y con resultados reales.</p>
                        <div class="row mb-4">
                            <div class="col-6">
                                <img class="img-fluid" src="img/about-1.jpg" alt="">
                            </div>
                            <div class="col-6">
                                <img class="img-fluid" src="img/about-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Feature Start -->
    <div class="container-fluid pb-5">
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-money-check-alt text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Precios Competitivos</h5>
                            <p class="m-0">Conectamos estudiantes con docentes expertos a precios accesibles y soluciones efectivas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-award text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Mejores Servicios</h5>
                            <p class="m-0">Ofrecemos una plataforma para apoyo personalizado en temas específicos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-globe text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Cobertura Global</h5>
                            <p class="m-0">Unimos a estudiantes y docentes de todo el mundo para facilitar el aprendizaje.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- Destination Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Asignaturas</h6>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid" src="img/destination-1.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">Asignatura</h5>
                            <span>Quimica</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid" src="img/destination-2.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">Asignatura</h5>
                            <span>Matemáticas</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid" src="img/destination-3.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">Asignatura</h5>
                            <span>Ingles</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid" src="img/destination-4.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">Asignatura</h5>
                            <span>Historia</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid" src="img/destination-5.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">Asignatura</h5>
                            <span>Fisica</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid" src="img/destination-6.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">Asignatura</h5>
                            <span>Informatica</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Destination Start -->


    <!-- Service Start -->
    <div class="container-fluid px-0 py-5 my-5">
        <div class="row mx-0 justify-content-center text-center">
            <div class="col-lg-6">
                <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">Contactanos</h6>
                <h1>Estamos para ayudarte</h1>
            </div>
        </div>
        <link rel="stylesheet" href="css\contactanos.css">

        <div class="container1">
            <div class="contact-box">
              <div class="left">
                <br>
                <div class="info-card">
                  <span class="icon">📞</span>
                  <div>
                    <h3>Comunicate con Nosotros</h3>
                    <p class="red">+57 320 7840766</p>
                  
                  </div>
                </div>
        <br>
        <br>
               
        
                <div class="info-card">
                  <span class="icon">✉️</span>
                  <div>
                    <h3>CORREO ELECTRÓNICO</h3>
                    <p class="red">classonvirtual@gmail.com</p>
                  </div>
                </div>
              </div>
        
              <div class="right">
                <h2>¿Tienes alguna pregunta?</h2>
                <p> Contáctanos y te ayudaremos a encontrar la mejor forma de resolverlo con apoyo personalizado.</p>
                <form>
                  <input type="text" placeholder="Ingresa tu nombre" required>
                  <input type="email" placeholder="Coloca tu Email" required>
                  <textarea placeholder="Tu mensaje " required></textarea>
                  <button type="submit">ENVIAR MENSAJE</button>
                </form>
              </div>
            </div>
          </div>
    <!-- Service End -->


    <!-- Packages Start -->
    <title>Planes Educativos</title>
  <link rel="stylesheet" href="css\paquetes.css" />
</head>
<body>
    <div class="titulo-contenedor">
        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Paquetes</h6>
        <h1> Elige el paquete ideal para ti</h1>
      </div>
      
            <br>
  <section class="planes">
    <div class="plan">
      <h2>Te Ayudo Ya</h2>
      <p class="precio">$9.900 COP</p>
      <ul>
        <li>1 sesión de 30 minutos</li>
        <li>Duda urgente o puntual</li>
        <li>Videollamada inmediata</li>
      </ul>
      <button>Reservar</button>
    </div>
    <div class="plan destacado">
      <h2>Explicámelo Bien</h2>
      <p class="precio">$18.000 COP</p>
      <ul>
        <li>1 sesión de 40 minutos</li>
        <li>Un tema específico</li>
        <li>Ejercicios paso a paso</li>
      </ul>
      <button>Reservar</button>
    </div>
    <div class="plan">
      <h2>Reforzamos Juntos</h2>
      <p class="precio">$45.000 COP</p>
      <ul>
        <li>2 sesiones de 40 minutos</li>
        <li>Hasta 3 temas</li>
        <li>Material de apoyo</li>
      </ul>
      <button>Reservar</button>
    </div> <br>

    <div class="plan">
      <h2>Estoy Perdido</h2>
      <p class="precio">$65.000 COP</p>
      <ul>
        <li>4 sesiones de 1 hora</li>
        <li>Diagnóstico + guía</li>
        <li>Preparación para examen</li>
      </ul>
      <button>Reservar</button>
    </div>
    <div class="plan">
      <h2>Acompáñame Todo el Mes</h2>
      <p class="precio">$120.000 COP</p>
      <ul>
        <li>8 sesiones de 1 hora</li>
        <li>Chat con docente-guias</li>
        <li>Plan mensual</li>
      </ul>
      <button>Reservar</button>
    </div>

    <div class="plan">
        <h2>Acompáñame Todo el Año</h2>
        <p class="precio">$230.000 COP</p>
        <ul>
          <li>20 sesiones de 1 hora</li>
          <li>Chat-guias-talleres</li>
          <li>Plan Anual</li>
        </ul>
        <button>Reservar</button>
      </div>
  </section>
    
    <!-- Packages End -->


    <!-- Registration Start -->
    <div class="container-fluid bg-registration py-5" style="margin: 90px 0;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">¡Gran Oportunidad!</h6>
                        <h1 class="text-white"><span class="text-primary">30%  </span> de descuento en tu primera asesoría</h1>
                    </div>
                    <p class="text-white">¿Tienes dudas en alguna materia? Conéctate con docentes certificados que te brindarán apoyo personalizado en los temas que más necesitas. Nuestra plataforma te ayuda a encontrar el experto ideal para superar cualquier dificultad académica.</p>
                    <ul class="list-inline text-white m-0">
                        <li class="py-2"><i class="fa fa-check text-primary mr-3"></i> Apoyo en temas específicos</li>
                        <li class="py-2"><i class="fa fa-check text-primary mr-3"></i> Docentes verificados</li>
                        <li class="py-2"><i class="fa fa-check text-primary mr-3"></i> Atención rápida y personalizada</li>
                    </ul>
                </div>
                <div class="col-lg-5">
                </div>
            </div>
        </div>
    </div>
    <!-- Registration End -->


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Nuestro equipo de </h6>
                <h1>DOCENTES</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                    <div class="team-item bg-white mb-4">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img\team-1.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <h5 class="text-truncate">Jeidy Ortiz</h5>
                            <p class="m-0">Física</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                    <div class="team-item bg-white mb-4">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img\team-2.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <h5 class="text-truncate">Antonio Requejo</h5>
                            <p class="m-0">Matemática</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                    <div class="team-item bg-white mb-4">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img\team-3.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <h5 class="text-truncate">Yolanda Arroyo</h5>
                            <p class="m-0">Química</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                    <div class="team-item bg-white mb-4">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img\team-4.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <h5 class="text-truncate">Jeferson Correa</h5>
                            <p class="m-0">Inglés</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Testimonios</h6>
                <h1>
                    Reseñas de nuestros usuarios</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="text-center pb-4">
                    <img class="img-fluid mx-auto" src="img\testimonial-4.jpg" style="width: 100px; height: 100px;" >
                    <div class="testimonial-text bg-white p-4 mt-n5">
                        <p class="mt-5">Me encanta la ayuda rápida y personalizada. Antes buscaba respuestas en internet, pero aquí los profesores explican eficientemente.
                        </p>
                        <h5 class="text-truncate">Sofia Perez</h5>
                        <span>Estudiante</span>
                    </div>
                </div>
                <div class="text-center">
                    <img class="img-fluid mx-auto" src="img\testimonial-3.jpg" style="width: 100px; height: 100px;" >
                    <div class="testimonial-text bg-white p-4 mt-n5">
                        <p class="mt-5">Gracias a esta plataforma, entiendo mejor los temas difíciles. Los profesores son pacientes y explican con ejemplos prácticos.
                        </p>
                        <h5 class="text-truncate">Carlos Mendez</h5>
                        <span>Estudiante universitario</span>
                    </div>
                </div>
                <div class="text-center">
                    <img class="img-fluid mx-auto" src="img\testimonial-2.jpg" style="width: 100px; height: 100px;" >
                    <div class="testimonial-text bg-white p-4 mt-n5">
                        <p class="mt-5">Esta plataforma resuelve dudas rápidamente, con explicaciones claras y directas. La recomiendo a cualquier estudiante que necesite apoyo.
                        </p>
                        <h5 class="text-truncate">Ana Rodriguez</h5>
                        <span>Estudiante</span>
                    </div>
                </div>
                <div class="text-center">
                    <img class="img-fluid mx-auto" src="img\testimonial-1.jpg" style="width: 100px; height: 100px;" >
                    <div class="testimonial-text bg-white p-4 mt-n5">
                        <p class="mt-5">La flexibilidad y apoyo constante de las clases virtuales han mejorado mi aprendizaje y experiencia universitaria de manera significativa.
                        <h5 class="text-truncate">Juan Ramos</h5>
                        <span>Estudiante</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Nuestro blog</h6>
                <h1>Lo último de nuestro blog</h1>
            </div>
            <div class="row pb-3">
                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="blog-item2">
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="img\blog-4.jpg" alt="">
                            <div class="blog-date">
                                <small class="text-white text-uppercase">Mayo</small>
                            </div>
                        </div>
                        <div class="bg-white p-4">
                            <div class="d-flex mb-2">
                                <a class="text-primary text-uppercase text-decoration-none" href="">Grupo</a>
                                <span class="text-primary px-2">|</span>
                                <a class="text-primary text-uppercase text-decoration-none" href="">Docentes</a>
                            </div>
                            <a class="h5 m-0 text-decoration-none" href="">Estrategias efectivas para estudiar antes de un examen difícil</a>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="blog-item2">
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="img\blog-.jpg" alt="">
                            <div class="blog-date">
                               
                                <small class="text-white text-uppercase">Enero</small>
                            </div>
                        </div>
                        <div class="bg-white p-4">
                            <div class="d-flex mb-2">
                                <a class="text-primary text-uppercase text-decoration-none" href="">Docente</a>
                                <span class="text-primary px-2">|</span>
                                <a class="text-primary text-uppercase text-decoration-none" href="">Informatica</a>
                            </div>
                            <a class="h5 m-0 text-decoration-none" href="">Primeros pasos en programación: ¿cómo empezar si no sabes nada?</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="blog-item2">
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="img\blog-6.jpg" alt="">
                            <div class="blog-date">
                                <small class="text-white text-uppercase">Abril</small>
                            </div>
                        </div>
                        <div class="bg-white p-4">
                            <div class="d-flex mb-2">
                                <a class="text-primary text-uppercase text-decoration-none" href="">Docente</a>
                                <span class="text-primary px-2">|</span>
                                <a class="text-primary text-uppercase text-decoration-none" href="">Matemáticas</a>
                            </div>
                            <a class="h5 m-0 text-decoration-none" href="">¿Álgebra te confunde? Aprende a resolver ecuaciones paso a paso</a>
                        </div>
                    </div>
                </div>
               
              
            </div>
        </div>
    </div>
    <!-- Blog End -->


    <!-- Footer Start -->
    <?php include "./inc/footer.php" ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>