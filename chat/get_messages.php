<?php
session_start();
header('Content-Type: application/json');

$sender_id = $_SESSION['usuario']['id'];
$receiver_id = (int)$_GET['receiver_id'];

$pdo = new PDO("mysql:host=localhost;dbname=classonvirtual;charset=utf8mb4", "root", "");

$ids = [$sender_id, $receiver_id];
sort($ids);
$identifier = implode('_', $ids);

$sql = "SELECT cr.id AS chat_room_id FROM chat_rooms cr WHERE cr.room_identifier = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$identifier]);
$chat_room = $stmt->fetch();

if (!$chat_room) {
    echo json_encode([]);
    exit;
}

$chat_room_id = $chat_room['chat_room_id'];

$sql = "SELECT m.*, u.nombre AS sender_name 
        FROM messages m 
        JOIN users u ON m.user_id = u.id 
        WHERE m.chat_room_id = ? 
        ORDER BY m.created_at ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$chat_room_id]);

$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($messages);
