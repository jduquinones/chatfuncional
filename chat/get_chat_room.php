<?php
session_start();
require_once '../database/database.php';

$currentUserId = $_SESSION['usuario']['id'];
$otherUserId = $_GET['user_id'] ?? null;

if (!$otherUserId) {
    http_response_code(400);
    echo json_encode(['error' => 'Falta ID de usuario']);
    exit;
}

// Crear identificador consistente
$ids = [$currentUserId, $otherUserId];
sort($ids);
$identifier = implode('_', $ids);

// Buscar chat_room por identificador
$stmt = $pdo->prepare("SELECT id FROM chat_rooms WHERE room_identifier = ?");
$stmt->execute([$identifier]);
$chatRoom = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$chatRoom) {
    // Crear chat_room si no existe
    $stmt = $pdo->prepare("INSERT INTO chat_rooms (room_identifier, user1_id, user2_id) VALUES (?, ?, ?)");
    $stmt->execute([$identifier, $ids[0], $ids[1]]);
    $chatRoomId = $pdo->lastInsertId();
} else {
    $chatRoomId = $chatRoom['id'];
}

// Obtener mensajes del chat_room
$stmt = $pdo->prepare("
    SELECT m.id, m.contenido, m.user_id, u.nombre AS sender_name, m.created_at
    FROM messages m
    JOIN users u ON u.id = m.user_id
    WHERE m.chat_room_id = ?
    ORDER BY m.created_at ASC
");
$stmt->execute([$chatRoomId]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($messages);
