<?php 
    if ($_SERVER['REQUEST_METHOD']!== 'POST') {
        header('Location: ragister.php');
        exit;
    }

    $name = $_POST['name'] ?? '';
    $furigana = $_POST['furigana'] ?? '';
    $postcodeA = $_POST['postcodeA'] ?? '';
    $postcodeB = $_POST['postcodeB'] ?? '';
    $address = $_POST['address'] ?? '';
    $mailaddress = $_POST['mailaddress'] ?? '';
    $mailConfirm = $_POST['mailConfirm'] ?? '';
    $passwordA = $_POST['passwordA'] ?? '';
    $passwordB = $_POST['passwordB'] ?? '';
?>

<?php require __DIR__ . '/header.php'; ?>

<div class="designWrap">
    <h1>入力確認</h1>

    <div>
        <p>お名前</p>
        <p><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></p>
    </div>

    <div>
        <p>お名前（フリガナ）</p>
        <p><?= htmlspecialchars($furigana, ENT_QUOTES, 'utf-8') ?></p>
    </div>
    
    <div>
        <p>郵便番号</p>
        <p>
            <?= htmlspecialchars($postcodeA, ENT_QUOTES, 'utf-8') ?>
            -
            <?= htmlspecialchars($postcodeB, ENT_QUOTES, 'utf-8') ?>
        </p>
     </div>
    
    <div>
        <p>住所</p>
        <p><?= htmlspecialchars($address, ENT_QUOTES, 'utf-8') ?>
    </div>
    
    <div>
        <p>メールアドレス</p>
        <p><?= htmlspecialchars($mailaddress, ENT_QUOTES, 'utf-8') ?>
    </div>
    
    <div>
        <p>メールアドレス確認用</p>
        
    </div>
    
    <div>
    </div>

</div>

<?php require __DIR__ . '/footer.php'; ?>