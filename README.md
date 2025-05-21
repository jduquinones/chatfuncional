# 📚 Documentación Técnica - Módulo de Chat Funcional

## Proyecto: ClassOnVirtual

### 🎯 Objetivo
Permitir la comunicación entre estudiantes y docentes mediante un chat privado y en tiempo real.

---

## 📌 1. Descripción General

El sistema de chat permitirá a los estudiantes interactuar con los docentes en sesiones individuales, garantizando **privacidad**, **seguridad** y **disponibilidad en tiempo real**.

---

## 📁 2. Estructura del Módulo

### 2.1. Componentes principales

| Componente       | Descripción                                                                 |
|------------------|-----------------------------------------------------------------------------|
| **Frontend Chat** | Interfaz de usuario para la mensajería. Muestra conversaciones, permite escribir mensajes y recibirlos en tiempo real. |
| **API Backend**   | Controlador para enviar/recibir mensajes y gestionar conversaciones.       |
| **Base de Datos** | Tablas que almacenan conversaciones y mensajes.                            |
| **Sistema de Eventos** | Canaliza los mensajes en tiempo real. Puede usar WebSockets o servicios como Pusher. |
| **Autenticación** | Control de acceso al módulo. Filtra por roles (estudiante, docente).       |

---

## 📦 3. Requisitos Funcionales

- ✅ Estudiantes y docentes deben autenticarse para acceder al chat.
- ✅ Cada conversación es uno a uno (docente ↔ estudiante).
- ✅ El sistema debe soportar mensajería en tiempo real.
- ✅ El administrador puede registrar usuarios desde un módulo de gestión.
- ✅ Los mensajes deben almacenarse para consulta posterior (historial).

---

## 🔐 4. Autenticación y Roles

El sistema debe identificar a los usuarios autenticados y permitir el acceso al chat según su rol:

- **Estudiante**: puede escribir a sus docentes asignados.
- **Docente**: puede responder a los estudiantes.
- **Administrador**: puede ver y registrar usuarios.

---

## 🧱 5. Modelo de Base de Datos

Tablas necesarias:

- `users`: Manejo de estudiantes, docentes y administradores.
- `conversations`: Registro de interacciones entre usuario A y usuario B.
- `messages`: Cada mensaje enviado en una conversación.

> Cada mensaje debe estar relacionado con una conversación y con el usuario que lo envió.

---

## 🛠 6. Flujo de Trabajo del Chat

1. Inicio de sesión.
2. El usuario ve la lista de conversaciones previas.
3. Puede iniciar una conversación si no existe (el estudiante inicia con un docente).
4. Envía un mensaje → se almacena y se emite en tiempo real.
5. El destinatario recibe el mensaje automáticamente en pantalla.
6. Ambos usuarios pueden ver el historial completo.

---

## 👤 7. Módulo de Registro de Usuarios (por el administrador)

- Interfaz protegida (solo admins).
- Permite crear nuevos usuarios con:
  - Nombre
  - Correo
  - Contraseña
  - Rol (estudiante, docente)
- Listado y edición de usuarios.
- 🚫 No debe permitir que los usuarios se registren por su cuenta.

---

> ⚙️ Este módulo está diseñado para mejorar la comunicación académica dentro del entorno ClassOnVirtual, asegurando control, trazabilidad y eficiencia.
