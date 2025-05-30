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

        .chat-main {
            height: calc(100vh - 120px);
            /* Ajusta el 120px según la altura de tu header */
            max-height: none !important;
            overflow-y: auto;
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

    <?php if (isset($_SESSION['usuario']) && isset($_SESSION['allUsers'])):
        // echo "Usuario encontrado:\n";
        // print_r($_SESSION);
        // echo "\n";
    ?>
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
                            <span class="new-message-indicator">🟢</span>
                            <span class="username"><?= htmlspecialchars($user['nombre'] ?? 'Nombre no disponible') ?></span>
                            <span class="user-role">(<?= htmlspecialchars($user['rol'] ?? 'Rol no definido') ?>)</span>
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
                <form class="chat-input" id="message-form">
                    <button type="button" id="attach-btn">📎</button>
                    <input type="file" id="file-input" style="display:none;" accept="image/*,audio/*">
                    <input type="text" id="message" placeholder="Escribe un mensaje..." required>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>

        <script>
            // Pasar datos de PHP a JavaScript de forma segura
            const nombreUsuario = <?= json_encode($_SESSION['usuario']['nombre'] ?? '') ?>;
            const currentUserId = <?= json_encode($_SESSION['usuario']['id'] ?? null) ?>;
            let currentChatUserId = null;

            // Conexión con Socket.io
            const socket = io('http://localhost:3001', {
                reconnection: true,
                reconnectionAttempts: 5,
                reconnectionDelay: 1000
            });

            // Unirse al chat con el ID de usuario
            socket.on('connect', () => {
                console.log('Conectado al servidor de chat');
                if (currentUserId) {
                    socket.emit('join', currentUserId);
                }
            });

            // Manejar errores de conexión
            socket.on('connect_error', (error) => {
                console.error('Error de conexión:', error);
            });

            // Función para cargar el chat con un usuario
            function loadChat(element, userId, userName) {
                // Validaciones básicas
                if (!userId || userId === currentUserId) return;

                currentChatUserId = userId;
                document.getElementById('chat-user').textContent = userName;
                document.getElementById('message-form').style.display = 'flex';

                // Resetear selección anterior
                document.querySelectorAll('.user-item').forEach(item => {
                    item.classList.remove('active', 'has-new-message');
                    const indicator = item.querySelector('.new-message-indicator');
                    if (indicator) indicator.classList.remove('visible');
                });

                // Marcar como activo
                element.classList.add('active');

                // Cargar historial del chat
                fetch(`./chat/get_chat_room.php?user_id=${userId}`)
                    .then(res => {
                        if (!res.ok) throw new Error('Error en la respuesta');
                        return res.json();
                    })
                    .then(messages => {
                        const chatBox = document.getElementById('chat-box');
                        chatBox.innerHTML = '';

                        messages.forEach(msg => {
                            const isCurrentUser = msg.user_id == currentUserId;
                            const messageDiv = document.createElement('div');
                            messageDiv.className = `message ${isCurrentUser ? 'sent' : 'received'}`;
                            messageDiv.innerHTML = `<p><strong>${isCurrentUser ? 'Tú' : userName}:</strong> ${msg.contenido}</p>`;
                            chatBox.appendChild(messageDiv);
                        });

                        chatBox.scrollTop = chatBox.scrollHeight;
                    })
                    .catch(error => console.error('Error al cargar mensajes:', error));
            }

            // Enviar mensaje
            document.getElementById('message-form').addEventListener('submit', function(e) {
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

                // Mostrar mensaje localmente
                const chatBox = document.getElementById('chat-box');
                const messageDiv = document.createElement('div');
                messageDiv.className = 'message sent';
                messageDiv.innerHTML = `<p><strong>Tú:</strong> ${message}</p>`;
                chatBox.appendChild(messageDiv);
                chatBox.scrollTop = chatBox.scrollHeight;

                input.value = '';
            });

            // Recibir mensajes
            socket.on('receive_message', ({
                from,
                message
            }) => {
                if (from === currentChatUserId) {
                    // Mensaje del chat actual
                    const chatBox = document.getElementById('chat-box');
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message received';
                    messageDiv.innerHTML = `<p><strong>${document.getElementById('chat-user').textContent}:</strong> ${message}</p>`;
                    chatBox.appendChild(messageDiv);
                    chatBox.scrollTop = chatBox.scrollHeight;
                } else {
                    // Notificación de nuevo mensaje
                    const userItem = document.querySelector(`.user-item[data-user-id="${from}"]`);
                    if (userItem) {
                        const indicator = userItem.querySelector('.new-message-indicator');
                        if (indicator) indicator.classList.add('visible');
                        userItem.classList.add('has-new-message');
                    }
                }
            });

            // Nuevo usuario registrado
            socket.on('new_user', (user) => {
                const userList = document.getElementById('user-list');

                // Evitar duplicados
                if (document.querySelector(`.user-item[data-user-id="${user.id}"]`)) return;

                const userItem = document.createElement('li');
                userItem.className = 'user-item new-user';
                userItem.dataset.userId = user.id;
                userItem.onclick = () => loadChat(userItem, user.id, user.nombre);

                userItem.innerHTML = `
            <img src="https://randomuser.me/api/portraits/${user.gender === 'female' ? 'women' : 'men'}/${Math.floor(Math.random() * 99) + 1}.jpg" alt="">
            <span class="status-indicator"></span>
            <span class="username">${user.nombre}</span>
            <span class="user-role">(${user.rol})</span>
            ${user.id === currentUserId ? '<span class="badge bg-primary">Tú</span>' : ''}
        `;

                userList.appendChild(userItem);

                // Animación para nuevo usuario
                setTimeout(() => {
                    userItem.classList.remove('new-user');
                }, 3000);
            });
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