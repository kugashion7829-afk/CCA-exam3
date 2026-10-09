<?php 
    require_once __DIR__ . '/app/session.php';
    
    if ($_SERVER['REQUEST_METHOD']!== 'POST') {
        header('Location: register.php');
        exit;
    }

    // 前回の確認情報を無効にしてから、新しい入力を検証する
    unset($_SESSION['register'], $_SESSION['registerToken']);
    if (!hasValidCsrfToken()) {
        http_response_code(403);
        exit('送信内容を確認できません。入力画面からやり直してください。');
    }
    foreach (['name', 'furigana', 'postcodeA', 'postcodeB', 'address', 'mailaddress', 'mailConfirm', 'passwordA', 'passwordB'] as $field) {
        if (!isset($_POST[$field]) || !is_string($_POST[$field])) {
            http_response_code(400);
            exit('入力形式が正しくありません。');
        }
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

    if (trim($name) === '' || trim($furigana) === '' || trim($address) === '') {
        exit('お名前・フリガナ・住所を入力してください。');
    }

    if ($mailaddress === '' || $mailaddress !== $mailConfirm) {
        exit('メールアドレスが未入力、または確認欄と一致していません。');
    }

    if (preg_match('/\A[^\s@]+@[^\s@]+\.[^\s@]+\z/u', $mailaddress) !== 1) {
        exit('メールアドレスの形が正しくありません。');
    }

    if ($passwordA === '' || $passwordA !== $passwordB) {
        exit('パスワードが未入力、または確認欄と一致していません。');
    }

    if (preg_match('/\A[0-9]{3}\z/', $postcodeA) !== 1 || preg_match('/\A[0-9]{4}\z/', $postcodeB) !== 1) {
        exit('郵便番号は、上3桁・下4桁の半角数字で入力してください。');
    }

    if (preg_match('/\A[A-Za-z0-9]{8,20}\z/', $passwordB) !== 1) {
        exit ('パスワードは半角英数字8~20文字で入力してください。');
    }

    if (mb_strlen($name, 'UTF-8') > 100 || mb_strlen($furigana, 'UTF-8') > 100 || mb_strlen($address, 'UTF-8') > 200 || mb_strlen($mailaddress, 'UTF-8') > 100) {
        exit('入力できる文字数を超過しています。名前・フリガナ・メールアドレスは100文字以内、住所は200文字以内で入力してください。');
    }

    require_once __DIR__ . '/app/db.php';

    $stmt = $pdo->prepare(
        'SELECT id FROM customers WHERE mail = :mail'
    );

    $stmt->execute([
        'mail' => $mailaddress
    ]);

    $customer = $stmt->fetch();

    if ($customer !== false) {
        exit('このメールアドレスはすでに登録されています。');
    }

    $_SESSION['register'] = [
        'name' => $name,
        'furigana' => $furigana,
        'postcodeA' => $postcodeA,
        'postcodeB' => $postcodeB,
        'address' => $address,
        'mailaddress' => $mailaddress,
        'passwordHash' => password_hash($passwordA, PASSWORD_DEFAULT)
    ];

    $_SESSION['registerToken'] = bin2hex(random_bytes(32));

?>

<?php require __DIR__ . '/header.php'; ?>

<div class="designWrapUsers comfirmPage">
    <h1 class="usersDesign">入力確認</h1>

    <div class="comfirmContainer">
        <p class="comfirmSubtitle">お名前</p>
        <p class="comfirmText"><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></p>
    </div>

    <div class="comfirmContainer">
        <p class="comfirmSubtitle">お名前（フリガナ）</p>
        <p class="comfirmText"><?= htmlspecialchars($furigana, ENT_QUOTES, 'UTF-8') ?></p>
    </div>
    
    <div class="comfirmContainer">
        <p class="comfirmSubtitle">郵便番号</p>
        <p class="comfirmText">
            <?= htmlspecialchars($postcodeA, ENT_QUOTES, 'UTF-8') ?>
            <?= htmlspecialchars($postcodeB, ENT_QUOTES, 'UTF-8') ?>
        </p>
     </div>
    
    <div class="comfirmContainer">
        <p class="comfirmSubtitle">住所</p>
        <p class="comfirmText"><?= htmlspecialchars($address, ENT_QUOTES, 'UTF-8') ?></p>
    </div>
    
    <div class="comfirmContainer">
        <p class="comfirmSubtitle">メールアドレス</p>
        <p class="comfirmText"><?= htmlspecialchars($mailaddress, ENT_QUOTES, 'UTF-8') ?></p>
    </div>
    
    <div class="comfirmContainer">
        <p class="comfirmSubtitle">メールアドレス確認用</p>
        <p class="comfirmText"><?= htmlspecialchars($mailConfirm, ENT_QUOTES, 'UTF-8') ?></p>
    </div>
    
    <div class="comfirmContainer">
        <p class="comfirmSubtitle">パスワード</p>
        <p class="comfirmText"><?= htmlspecialchars($passwordA, ENT_QUOTES, 'UTF-8') ?></p>
    </div>

    <div class="comfirmContainer">
        <p class="comfirmSubtitle">パスワード確認用</p>
        <p class="comfirmText"><?= htmlspecialchars($passwordB, ENT_QUOTES, 'UTF-8') ?></p>
    </div>

    <form action="registerComplete.php" method="post">
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['registerToken'], ENT_QUOTES, 'UTF-8') ?>">
        <button class="submitButton" type="submit">登録する</button>
    </form>

</div>

<?php require __DIR__ . '/footer.php'; ?>