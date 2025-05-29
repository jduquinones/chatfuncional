<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>ClassOn Virtual</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>


    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap y estilos -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/servicios.css" rel="stylesheet">
</head>

<body>
    <style>
        .user-item {
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .user-item:hover {
            background-color: #f0f0f0;
        }

        .user-item.active {
            background-color: #e0e0e0;
        }

        .user-item.has-new-message {
            font-weight: bold;
            background-color: #fdf2d0;
        }

        .new-message-indicator {
            margin-left: 10px;
            color: green;
            font-size: 1em;
            display: none;
            /* oculto por defecto */
        }

        .new-message-indicator.visible {
            display: inline;
        }


        .no-chat-selected {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            color: #888;
        }
        .chat-main{
            max-height: 50vh !important;
        }
        footer {
            margin: 0;
        }
    </style>
    <?php include "./inc/header.php" ?>

    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Servicios</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="/">Inicio</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Servicios</p>
                </div>
            </div>
        </div>
    </div>

    <?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    ?>

    <?php if (isset($_SESSION['usuario']) && isset($_SESSION['allUsers'])): ?>
        <br><br>
        <div class="chat-container">
            <div class="sidebar">
                <h2>Centro de atención</h2>
                <ul id="user-list">
                    <?php foreach ($_SESSION['allUsers'] as $user): ?>
                        <li class="user-item" data-user-id="<?= (int) $user['id'] ?>"
                            onclick="loadChat(this, <?= (int) $user['id'] ?>, '<?= htmlspecialchars($user['nombre'], ENT_QUOTES) ?>')">
                            <img src="https://randomuser.me/api/portraits/<?= ($user['gender'] ?? 'male') === 'female' ? 'women' : 'men' ?>/<?= rand(1, 99) ?>.jpg"
                                alt="">
                            <span class="username"><?= htmlspecialchars($user['nombre'] ?? 'Nombre no disponible') ?></span>
                            <span class="new-message-indicator">🟢</span>
                            
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="chat-main">
                <div class="chat-header">Chat con <span id="chat-user">Seleccione un usuario</span></div>
                <div class="chat-messages" id="chat-box">
                    <div class="no-chat-selected">
                        <p>Seleccione un usuario para comenzar a chatear</p>
                    </div>
                </div>
                <form class="chat-input" id="message-form" style="display:none;">
                    <button type="button" id="attach-btn">📎</button>
                    <input type="file" id="file-input" style="display:none;" accept="image/*,audio/*">
                    <input type="text" id="message" placeholder="Escribe un mensaje..." required>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>

        <script>
            const socket = io('http://localhost:3001');

            const currentUserId = <?= (int) $_SESSION['usuario']['id'] ?>;
            let currentChatUserId = null;

            socket.emit('join', currentUserId);

            function loadChat(element, userId, userName) {
                currentChatUserId = userId;
                document.getElementById('chat-user').textContent = userName;
                document.getElementById('message-form').style.display = 'flex';

                document.querySelectorAll('.user-item').forEach(item => {
                    item.classList.remove('active');
                    // Limpiar indicadores en todos
                    const ind = item.querySelector('.new-message-indicator');
                    if (ind) ind.classList.remove('visible');
                    item.classList.remove('has-new-message');
                });
                element.classList.add('active');

                // (opcional) puedes seguir usando fetch aquí para cargar historial
                fetch(`./chat/get_chat_room.php?user_id=${userId}`)
                    .then(res => res.json())
                    .then(messages => {
                        const chatBox = document.getElementById('chat-box');
                        chatBox.innerHTML = '';
                        messages.forEach(msg => {
                            const messageDiv = document.createElement('div');
                            messageDiv.className = `message ${msg.user_id == currentUserId ? 'sent' : 'received'}`;
                            messageDiv.innerHTML = `<p><strong>${msg.user_id == currentUserId ? 'Tú' : userName}:</strong> ${msg.contenido}</p>`;
                            chatBox.appendChild(messageDiv);
                        });
                        chatBox.scrollTop = chatBox.scrollHeight;
                    });

            }

            document.getElementById('message-form').addEventListener('submit', function (e) {
                e.preventDefault();
                if (!currentChatUserId) return;

                const input = document.getElementById('message');
                const message = input.value.trim();
                if (!message) return;

                socket.emit('send_message', {
                    from: currentUserId,
                    to: currentChatUserId,
                    message
                });

                appendMessage('Tú', message, true);
                input.value = '';
            });

            socket.on('receive_message', function ({
                from,
                message
            }) {
                if (from == currentChatUserId) {
                    appendMessage('Ellos', message, false);
                } else {
                    const userItem = document.querySelector(`.user-item[data-user-id="${from}"]`);
                    if (userItem) {
                        const indicator = userItem.querySelector('.new-message-indicator');
                        if (indicator) indicator.classList.add('visible');
                        userItem.classList.add('has-new-message'); // opcional para fondo/negrita
                    }
                }
            });

            function appendMessage(sender, message, isSent) {
                const chatBox = document.getElementById('chat-box');
                const messageDiv = document.createElement('div');
                messageDiv.className = 'message ' + (isSent ? 'sent' : 'received');
                messageDiv.innerHTML = `<p><strong>${sender}:</strong> ${message}</p>`;
                chatBox.appendChild(messageDiv);
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        </script>



    <?php endif; ?>

    <?php include "./inc/footer.php" ?>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>
    <script src="js/main.js"></script>
    <script src="js/servicios.js"></script>
</body>

</html>