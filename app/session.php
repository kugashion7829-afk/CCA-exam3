<?php
// セッションとフォーム送信用トークンの共通初期化
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['csrfToken'])) {
    $_SESSION['csrfToken'] = bin2hex(random_bytes(32));
}

function hasValidCsrfToken(): bool
{
    $token = $_POST['csrfToken'] ?? '';
    return is_string($token) && hash_equals($_SESSION['csrfToken'], $token);
}
