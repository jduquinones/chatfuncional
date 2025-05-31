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

        .file-upload-wrapper {
            position: relative;
            display: inline-block;
            overflow: hidden;
            border: 1px solid #ccc;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #333;
            cursor: pointer;
            font-family: sans-serif;
            font-size: 1em;
        }

        .file-upload-wrapper:hover {
            background-color: #eee;
        }

        .file-upload-wrapper span {
            display: inline-block;
        }

        #file-input {
            position: absolute;
            top: 0;
            left: 0;
            margin: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            padding-left: 56px;
            z-index: 1;
        }

        #record-button,
        #stop-button {
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            cursor: pointer;
            margin: 0;
        }

        .record-button-container {
            border: 1px solid #ccc;
            padding: 10px 15px;
            border-radius: 5px;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            cursor: pointer;
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
                <form class="chat-input" id="message-form" style="display:none;">
                    <div class="record-button-container">
                        <button type="button" id="record-button">🎙️</button>
                        <button type="button" id="stop-button" style="display:none;">✅</button>
                    </div>
                    <div class="file-upload-wrapper">
                        <input type="file" id="file-input" accept="image/*,audio/*,.pdf,.doc,.docx,.xls,.xlsx"
                            style="display:none;">
                        <span>📎</span>
                    </div>
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

            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message');
            const fileInput = document.getElementById('file-input');
            const fileUploadWrapper = document.querySelector('.file-upload-wrapper'); // Aunque no lo usemos directamente para el trigger aquí
            const recordButton = document.getElementById('record-button');
            const stopButton = document.getElementById('stop-button');
            let mediaRecorder;
            let audioChunks = [];

            fileUploadWrapper.addEventListener('click', () => {
                fileInput.click(); // Simula un clic en el input de archivo oculto
            });

            recordButton.addEventListener('click', async () => {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({
                        audio: true
                    });
                    mediaRecorder = new MediaRecorder(stream);
                    audioChunks = [];

                    mediaRecorder.ondataavailable = event => {
                        if (event.data.size > 0) {
                            audioChunks.push(event.data);
                        }
                    };

                    mediaRecorder.onstop = () => {
                        const audioBlob = new Blob(audioChunks, {
                            type: 'audio/webm'
                        });
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            const base64Audio = reader.result.split(',')[1];
                            socket.emit('send_audio', {
                                from: currentUserId,
                                to: currentChatUserId,
                                audioData: base64Audio,
                                mimeType: 'audio/webm'
                            });
                            console.log('Audio grabado y enviado.');
                            // Mostrar un mensaje para el remitente
                            appendMessage('Tú', 'Audio enviado', true, {
                                audio: true
                            });
                        };
                        reader.readAsDataURL(audioBlob);
                    };

                    recordButton.style.display = 'none';
                    stopButton.style.display = 'flex';
                    mediaRecorder.start();
                    console.log('Grabando audio...');

                } catch (err) {
                    console.error("Error al acceder al micrófono:", err);
                    alert('No se pudo acceder al micrófono.');
                }
            });

            stopButton.addEventListener('click', () => {
                if (mediaRecorder && mediaRecorder.state === 'recording') {
                    mediaRecorder.stop();
                    recordButton.style.display = 'flex';
                    stopButton.style.display = 'none';
                    console.log('Grabación detenida.');
                }
            });

            socket.on('receive_audio_url', function(audioData) {
                if (audioData.from == currentChatUserId) {
                    console.log('Audio recibido (URL):', audioData);
                    const chatBox = document.getElementById('chat-box');
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message received audio-message';
                    const audio = document.createElement('audio');
                    audio.controls = true;
                    const audioUrl = `chat/download.php?ruta=${encodeURIComponent(audioData.ruta)}`;
                    audio.src = audioUrl;
                    messageDiv.innerHTML = '<p><strong>Te enviaron un audio:</strong></p>';
                    messageDiv.appendChild(audio);
                    chatBox.appendChild(messageDiv);
                    chatBox.scrollTop = chatBox.scrollHeight;
                } else {
                    const userItem = document.querySelector(`.user-item[data-user-id="${audioData.from}"]`);
                    if (userItem) {
                        const indicator = userItem.querySelector('.new-message-indicator');
                        if (indicator) indicator.classList.add('visible');
                        userItem.classList.add('has-new-message');
                    }
                }
            });

            function appendMessage(sender, message, isSent, media = null) {
                const chatBox = document.getElementById('chat-box');
                const messageDiv = document.createElement('div');
                messageDiv.className = 'message ' + (isSent ? 'sent' : 'received');
                let messageContent = `<p><strong>${sender}:</strong> ${message}</p>`;
                if (media && media.audio) {
                    messageContent = `<p><strong>${sender}:</strong> Audio enviado</p>`;
                } else if (media && media.nombre && media.ruta) {
                    const downloadUrl = `chat/download.php?ruta=${encodeURIComponent(media.ruta)}`;
                    messageContent = `<p><strong>${sender} enviaron un archivo:</strong> <a href="${downloadUrl}" download="${media.nombre}">${media.nombre}</a></p>`;
                }
                messageDiv.innerHTML = messageContent;
                chatBox.appendChild(messageDiv);
                chatBox.scrollTop = chatBox.scrollHeight;
            }

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
                messageForm.style.display = 'flex';

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
                            messageDiv.className = `message ${msg.user_id == currentUserId ? 'sent' : 'received'}`;
                            messageDiv.innerHTML = `<p><strong>${isCurrentUser ? 'Tú' : userName}:</strong> ${msg.contenido}</p>`;
                            let messageContent = '';
                            if (msg.archivo_nombre && msg.archivo_nombre.startsWith('audio')) {
                                const audioUrl = `chat/download.php?ruta=${encodeURIComponent(msg.archivo_ruta)}`;
                                messageContent = `<p><strong>${msg.user_id == currentUserId ? 'Tú' : userName} envió un audio:</strong></p><audio controls src="${audioUrl}"></audio>`;
                            } else if (msg.archivo_nombre) {
                                const downloadUrl = `chat/download.php?ruta=${encodeURIComponent(msg.archivo_ruta)}`;
                                messageContent = `<p><strong>${msg.user_id == currentUserId ? 'Tú' : userName} enviaron un archivo:</strong> <a href="${downloadUrl}" download="${msg.archivo_nombre}">${msg.archivo_nombre}</a></p>`;
                            } else {
                                messageContent = `<p><strong>${msg.user_id == currentUserId ? 'Tú' : userName}:</strong> ${msg.contenido}</p>`;
                            }
                            messageDiv.innerHTML = messageContent;
                            chatBox.appendChild(messageDiv);
                        });
                        chatBox.scrollTop = chatBox.scrollHeight;
                    });
            }

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0 && currentChatUserId) {
                    const file = fileInput.files[0];
                    const reader = new FileReader();

                    const timestamp = Date.now();
                    const sanitizedName = file.name.replace(/\s+/g, '_');
                    const uniqueFileName = `${timestamp}_${sanitizedName}`;

                    reader.onload = function() {
                        socket.emit('send_file', {
                            from: currentUserId,
                            to: currentChatUserId,
                            name: uniqueFileName,
                            type: file.type,
                            size: file.size,
                            data: reader.result // Enviar como ArrayBuffer
                        });

                        // ❌ NO LLAMES appendMessage aquí todavía
                        fileInput.value = '';
                    };

                    reader.readAsArrayBuffer(file);
                }
            });

            // ✅ Esperar confirmación del servidor antes de mostrar
            socket.on('file_saved_confirm', (fileInfo) => {
                appendMessage('Tú', `Archivo adjunto: ${fileInfo.name}`, true, {
                    nombre: fileInfo.name,
                    ruta: fileInfo.ruta
                });
            });

            // Este escucha si el receptor es otro usuario
            socket.on('receive_file', (fileInfo) => {
                appendMessage('Otro', `Archivo adjunto: ${fileInfo.name}`, false, {
                    nombre: fileInfo.name,
                    ruta: fileInfo.ruta
                });
            });



            // Enviar mensaje
            document.getElementById('message-form').addEventListener('submit', function(e) {
                e.preventDefault();
                if (!currentChatUserId) return;

                const message = messageInput.value.trim();
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

                // document.getElementById('file-input').value = "";

                document.getElementById('message').value = "";
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

            socket.on('receive_file', function(fileData) {
                if (fileData.from == currentChatUserId) {
                    console.log('Archivo recibido:', fileData);
                    const chatBox = document.getElementById('chat-box');
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message received file-message';

                    // Usar siempre el mismo método de descarga
                    const downloadUrl = `chat/download.php?ruta=${encodeURIComponent(fileData.ruta)}&t=${Date.now()}`;
                    const fileDisplay = `
            <p><strong>Te enviaron un archivo:</strong> 
            <a href="${downloadUrl}" download="${fileData.name}">
                ${fileData.name} (${(fileData.size / 1024).toFixed(2)} KB)
            </a></p>`;

                    messageDiv.innerHTML = fileDisplay;
                    chatBox.appendChild(messageDiv);
                    chatBox.scrollTop = chatBox.scrollHeight;
                } else {
                    const userItem = document.querySelector(`.user-item[data-user-id="${fileData.from}"]`);
                    if (userItem) {
                        const indicator = userItem.querySelector('.new-message-indicator');
                        if (indicator) indicator.classList.add('visible');
                        userItem.classList.add('has-new-message');
                    }
                }
            });

            function arrayBufferToBase64(buffer) {
                let binary = '';
                const bytes = new Uint8Array(buffer);
                const len = bytes.byteLength;
                for (let i = 0; i < len; i++) {
                    binary += String.fromCharCode(bytes[i]);
                }
                return btoa(binary);
            }

            function downloadFile(name, type, base64Data) {
                const link = document.createElement('a');
                link.href = `data:${type};base64,${base64Data}`;
                link.download = name;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }

            function appendMessage(sender, message, isSent) {
                const chatBox = document.getElementById('chat-box');
                const messageDiv = document.createElement('div');
                messageDiv.className = 'message ' + (isSent ? 'sent' : 'received');
                messageDiv.innerHTML = `<p><strong>${sender}:</strong> ${message}</p>`;
                chatBox.appendChild(messageDiv);
                chatBox.scrollTop = chatBox.scrollHeight;
            }
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