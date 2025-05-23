<?php
require_once __DIR__ . '/../database/chat.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chat_room_id = $_POST['chat_room_id'];
    $user_id = $_POST['user_id'];
    $contenido = $_POST['contenido'];

    $stmt = $pdo->prepare("INSERT INTO messages (chat_room_id, user_id, contenido) VALUES (?, ?, ?)");
    $stmt->execute([$chat_room_id, $user_id, $contenido]);

    echo json_encode(['status' => 'success']);
}
