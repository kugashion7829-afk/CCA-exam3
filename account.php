<?php
    session_start();

    if (!isset($_SESSION['customer'])) {
        header('Location: login.php');
        exit;
    }

    if (!isset($_SESSION['logoutToken'])) {
        $_SESSION['logoutToken'] = bin2hex(random_bytes(32));
    }

    require __DIR__ . '/header.php';
?>

<div class="designWrapUsers accountPage">
    <h1 class="usersDesign">アカウント</h1>

    <div class="completeContainer">
        <p>こんにちは</p>
        <p>
            <?=htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8') ?>さん
        </p>
    </div>

    <form action="logout.php" method="post">
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['logoutToken'], ENT_QUOTES, 'UTF-8') ?>">
        <button class="submitButton" type="submit">ログアウト</button>
    </form>
</div>

<?php require __DIR__ . '/footer.php'; ?>