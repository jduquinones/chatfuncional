// chat.js
const form = document.getElementById('message-form');
const input = document.getElementById('message');
const chatBox = document.getElementById('chat-box');
const fileInput = document.getElementById('file-input');
const attachBtn = document.getElementById('attach-btn');

// Mensajes automáticos de respuesta
const respuestasBot = [
  "¡Hola! ¿En qué te puedo ayudar?",
  "Gracias por escribirnos. Un momento por favor...",
  "Estamos revisando tu mensaje.",
  "¿Puedes explicarlo con más detalle?",
  "Ya te estamos contactando con un profesor."
];

function enviarMensaje(texto, tipo = 'sent') {
  const mensaje = document.createElement('div');
  mensaje.classList.add('message', tipo);
  mensaje.innerHTML = `<p>${texto}</p>`;
  chatBox.appendChild(mensaje);
  chatBox.scrollTop = chatBox.scrollHeight;
}

function respuestaAutomatica() {
  const random = Math.floor(Math.random() * respuestasBot.length);
  setTimeout(() => {
    enviarMensaje(`<strong>Asistente:</strong> ${respuestasBot[random]}`, 'received');
  }, 1500);
}

form.addEventListener('submit', e => {
  e.preventDefault();
  const texto = input.value.trim();
  if (texto !== '') {
    enviarMensaje(`<strong>Tú:</strong> ${texto}`);
    input.value = '';
    respuestaAutomatica();
  }
});

attachBtn.addEventListener('click', () => {
  fileInput.click();
});

fileInput.addEventListener('change', () => {
  const archivo = fileInput.files[0];
  if (archivo) {
    const tipo = archivo.type;
    const reader = new FileReader();
    reader.onload = e => {
      let contenido = '';
      if (tipo.startsWith('image/')) {
        contenido = `<strong>Tú:</strong><br><img src="${e.target.result}" style="max-width: 150px;">`;
      } else if (tipo.startsWith('audio/')) {
        contenido = `<strong>Tú:</strong><br><audio controls src="${e.target.result}"></audio>`;
      } else {
        contenido = `<strong>Tú:</strong> Archivo adjunto: ${archivo.name}`;
      }
      enviarMensaje(contenido);
    };
    reader.readAsDataURL(archivo);
  }
});

// Grabación de audio (opcional)
const micBtn = document.createElement('button');
micBtn.type = 'button';
micBtn.innerText = '🎤';
micBtn.style.marginRight = '8px';
micBtn.style.fontSize = '1.5rem';
micBtn.style.background = 'none';
micBtn.style.border = 'none';
micBtn.style.cursor = 'pointer';
micBtn.style.color = '#007bff';
document.querySelector('.chat-input').insertBefore(micBtn, input);

let mediaRecorder;
let audioChunks = [];

micBtn.addEventListener('click', async () => {
  if (!mediaRecorder || mediaRecorder.state === 'inactive') {
    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
    mediaRecorder = new MediaRecorder(stream);

    mediaRecorder.ondataavailable = e => audioChunks.push(e.data);
    mediaRecorder.onstop = () => {
      const audioBlob = new Blob(audioChunks, { type: 'audio/mp3' });
      const audioURL = URL.createObjectURL(audioBlob);
      enviarMensaje(`<strong>Tú:</strong><br><audio controls src="${audioURL}"></audio>`);
      audioChunks = [];
    };

    mediaRecorder.start();
    micBtn.innerText = '⏹️';
  } else {
    mediaRecorder.stop();
    micBtn.innerText = '🎤';
  }
});