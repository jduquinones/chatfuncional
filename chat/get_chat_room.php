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

// Buscar si existe chat_room para estos dos usuarios
$stmt = $pdo->prepare("
    SELECT cr.id 
    FROM chat_rooms cr
    JOIN chat_room_user cru1 ON cru1.chat_room_id = cr.id AND cru1.user_id = ?
    JOIN chat_room_user cru2 ON cru2.chat_room_id = cr.id AND cru2.user_id = ?
    LIMIT 1
");
$stmt->execute([$currentUserId, $otherUserId]);
$chatRoom = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$chatRoom) {
    // Crear chat_room
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("INSERT INTO chat_rooms () VALUES ()");
    $stmt->execute();
    $chatRoomId = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO chat_room_user (chat_room_id, user_id) VALUES (?, ?), (?, ?)");
    $stmt->execute([$chatRoomId, $currentUserId, $chatRoomId, $otherUserId]);

    $pdo->commit();
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
