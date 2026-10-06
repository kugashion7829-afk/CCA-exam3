<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mailaddress = $_POST['mailaddress'] ?? '';
    $password = $_POST['password'] ?? '';

    if (
        !is_string($mailaddress) ||
        !is_string($password) ||
        trim($mailaddress) === '' ||
        $password === ''
    ) {
        $error = 'メールアドレスとパスワードを入力してください。';
    } else {
        require_once __DIR__ . '/app/db.php'; 
    
        $stmt = $pdo->prepare(
            'SELECT id, name, password
            FROM customers
            WHERE mail = :mail'
        );

        $stmt->execute([
            'mail' => $mailaddress
        ]);
    
        $customer = $stmt->fetch();

        if ($customer === false || !password_verify($password, $customer['password'])) {
            $error = 'メールアドレスまたはパスワードが正しくありません。';
        } else {
            session_regenerate_id(true);

            $_SESSION['customer'] = [
                'id' => $customer['id'],
                'name' => $customer['name']
            ];

            header('Location: loginComplete.php', true, 303);
            exit;
        }
    }
}
?>

<?php require __DIR__ . '/header.php'; ?>

<div class="designWrapUsers">
    <h1 class="usersDesign">ログイン</h1>
    
    <?php if ($error !== ''): ?>
        <p role="alert">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <form class="loginContainerOuter" action="login.php" method="post">
        <div class="loginContainer">
            <label for="mailaddress">メールアドレス</label>
            <input type="email" id="mailaddress" name="mailaddress" autocomplete="username" required>
        </div>

        <div class="loginContainer">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" autocomplete="current-password" required>
        </div>

        <button class="submitButton" type="submit">ログインする</button>
    </form>

    <a class="visitRegister" href="register.php">会員登録はこちら</a>
</div>

<?php require __DIR__ . '/footer.php'; ?>