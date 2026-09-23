<?php

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/db_connection.php';

requireLogin();

$type = $_GET['type'] ?? '';
$id = (int)($_GET['id'] ?? 0);

if ($id <= 0 || !in_array($type, ['document', 'homework'], true)) {
    http_response_code(400);
    die('Invalid download request.');
}

if ($type === 'document') {
    $stmt = $conn->prepare('SELECT File_name FROM documents WHERE Ayxwn_arithmos = ?');
} else {
    $stmt = $conn->prepare('SELECT Ekfwnhsh FROM homeworks WHERE Ayxwn_arithmos = ?');
}

$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$row) {
    http_response_code(404);
    die('File not found.');
}

$storedName = $type === 'document' ? $row['File_name'] : $row['Ekfwnhsh'];
$path = UPLOAD_DIR . basename($storedName);
$realUpload = realpath(UPLOAD_DIR);
$realFile = realpath($path);

if ($realUpload === false || $realFile === false || !str_starts_with($realFile, $realUpload)) {
    http_response_code(404);
    die('File not found.');
}

$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($realFile) ?: 'application/octet-stream';

header('Content-Type: ' . $mime);
header('Content-Disposition: attachment; filename="' . basename($storedName) . '"');
header('Content-Length: ' . filesize($realFile));
readfile($realFile);
exit;

?>
