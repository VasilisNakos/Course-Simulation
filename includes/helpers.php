<?php

define('UPLOAD_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Files' . DIRECTORY_SEPARATOR);
define('UPLOAD_MAX_BYTES', 5 * 1024 * 1024);

const ALLOWED_EXTENSIONS = [
    'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif', 'txt', 'ppt', 'pptx',
];

function h(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function allowedExtension(string $filename): bool
{
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return in_array($ext, ALLOWED_EXTENSIONS, true);
}

function generateStoredFilename(string $originalName): string
{
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    return bin2hex(random_bytes(16)) . ($ext !== '' ? '.' . $ext : '');
}

function validateUploadedFile(array $file): ?string
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        return null;
    }

    if (($file['size'] ?? 0) > UPLOAD_MAX_BYTES) {
        return null;
    }

    $originalName = $file['name'] ?? '';
    if ($originalName === '' || !allowedExtension($originalName)) {
        return null;
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $allowedMimes = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'image/png',
        'image/jpeg',
        'image/gif',
        'text/plain',
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    ];

    if (!in_array($mime, $allowedMimes, true)) {
        return null;
    }

    return generateStoredFilename($originalName);
}

function storeUploadedFile(array $file, string $storedName): bool
{
    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0755, true);
    }

    $destination = UPLOAD_DIR . basename($storedName);
    return move_uploaded_file($file['tmp_name'], $destination);
}

function deleteStoredFile(?string $storedName): void
{
    if ($storedName === null || $storedName === '') {
        return;
    }

    $path = UPLOAD_DIR . basename($storedName);
    $realUpload = realpath(UPLOAD_DIR);
    $realFile = realpath($path);

    if ($realUpload !== false && $realFile !== false && str_starts_with($realFile, $realUpload)) {
        @unlink($realFile);
    }
}

function downloadPath(string $type, int $id): string
{
    return 'download.php?type=' . urlencode($type) . '&id=' . $id;
}

?>
