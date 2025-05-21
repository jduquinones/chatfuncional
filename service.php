<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ClassOn Virtual</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/servicios.css">
</head>

<body>
    <?php include "./inc/header.php" ?>

    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Servicios</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Inicio</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Servicios</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Chat -->
    <br><br>
    <div class="chat-container">
        <div class="sidebar">
            <h2>Centro de atención</h2>
            <ul id="user-list">
                <li class="active">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
                    <span class="username">José Hernández</span>
                </li>
                <li>
                    <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="">
                    <span class="username">Marta Salas</span>
                </li>
                <li>
                    <img src="https://randomuser.me/api/portraits/men/76.jpg" alt="">
                    <span class="username">Pedro Nieves</span>
                </li>
                <li>
                    <img src="https://randomuser.me/api/portraits/women/66.jpg" alt="">
                    <span class="username">Ana Ruiz</span>
                </li>
            </ul>
        </div>

        <div class="chat-main">
            <div class="chat-header">Chat con <span id="chat-user">José Hernández</span></div>
            <div class="chat-messages" id="chat-box">
                <div class="message received">
                    <p><strong>José Hernández:</strong> Hola, ¿me puedes ayudar con un tema?</p>
                </div>
            </div>
            <form class="chat-input" id="message-form">
                <button type="button" id="attach-btn">📎</button>
                <input type="file" id="file-input" style="display:none;" accept="image/*,audio/*">
                <input type="text" id="message" placeholder="Escribe un mensaje..." required>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>


    <!-- Footer Start -->
    <?php include "../inc/footer.php" ?>
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

    <script src="js/servicios.js"></script>
</body>

</html>