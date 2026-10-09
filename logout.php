<?php
require_once __DIR__ . '/app/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: account.php');
    exit;
}

$token = $_POST['token'] ?? '';
$sessionToken = $_SESSION['logoutToken'] ?? '';

if (
    !is_string($token) ||
    !is_string($sessionToken) ||
    $sessionToken === '' ||
    !hash_equals($sessionToken, $token)
) {
    exit('送信内容を確認できません。');
}

unset($_SESSION['customer'], $_SESSION['logoutToken']);

session_regenerate_id(true);

header('Location: login.php', true, 303);
exit;