<?php
$ruta = $_GET['ruta'] ?? '';

if (!empty($ruta) && strpos($ruta, 'uploads/') === 0) {
    $filepath = __DIR__ . '/../' . $ruta; // Ajusta la ruta base si es necesario

    if (file_exists($filepath)) {
        $filename = basename($filepath);
        $mime = mime_content_type($filepath);

        header('Content-Type: ' . $mime);
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($filepath));
        header('Cache-Control: private');
        session_cache_limiter('public');

        readfile($filepath);
        exit;
    } else {
        // El archivo no existe
        http_response_code(404);
        echo "Archivo no encontrado.";
        exit;
    }
} else {
    // Ruta inválida
    http_response_code(400);
    echo "Solicitud inválida.";
    exit;
}
?>