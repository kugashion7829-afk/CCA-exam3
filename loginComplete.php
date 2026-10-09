<?php
    require_once __DIR__ . '/app/session.php';

    if (!isset($_SESSION['customer'])) {
        header('Location: login.php');
        exit;
    }

    require __DIR__ . '/header.php';
?>

<div class="designWrapUsers loginCompletePage">
    <h1 class="usersDesign">ログイン完了</h1>

    <div class="completeContainer">
        <p>ログインが完了しました。</p>
        <p>引き続きお楽しみください。</p>
    </div>

    <div class="completeContainer">
        <a href="cart.php">カートへすすむ</a>
        <a href="./index.php">TOPページへもどる</a>
    </div>

</div>

<?php require __DIR__ . '/footer.php'; ?>