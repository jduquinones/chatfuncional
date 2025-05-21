<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>classOn Virtual</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<?php include "./inc/header.php" ?>
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Agenda y Citas</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Inicio</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Agenda y Citas</p>
                </div>
            </div>
        </div>
    </div>

<br>
    
    
    <link rel="stylesheet" href="css\agenda.css">
</head>
<body>
  <div class="header">

  </div>

  <div class="form-section">
    <form id="form-agenda">
      <label for="nombre">Nombre del estudiante</label>
      <input type="text" id="nombre" name="nombre" placeholder="Ej. Juan Pérez" required>

      <label for="fecha">Fecha de la clase</label>
      <input type="date" id="fecha" name="fecha" required>

      <label for="hora">Hora de la clase</label>
      <input type="time" id="hora" name="hora" required>

      <label for="duracion">Duración (Horas) *</label>
      <input type="number" id="duracion" name="duracion" min="1" max="5" required>

      <label for="asignatura">Asignatura</label>
      <select id="asignatura" name="asignatura" required>
        <option value="">Seleccione una materia</option>
        <option value="matematicas">Matemáticas</option>
        <option value="ingles">Inglés</option>
        <option value="fisica">Física</option>
        <option value="quimica">Química</option>
        <option value="historia">Historia</option>
      </select>

      <label for="tema">Tema puntual que necesites</label>
      <textarea id="tema" name="tema" rows="4" placeholder="Tema que tienes alguna falencia" required></textarea>

      <button type="submit">Agendar Clase</button>
    </form>
  </div>

  <div class="appointments-section">
    <h2>Clases Agendadas</h2>
    <ul id="lista-clases"></ul>
  </div>

  <script src="js\agenda.js"></script>

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