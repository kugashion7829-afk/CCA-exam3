<?php 
    require_once __DIR__ . '/app/session.php';

    if (
        $_SERVER['REQUEST_METHOD'] === 'GET' &&
        ($_SESSION['registerCompleted'] ?? false) === true
    ) {
        require __DIR__ . '/header.php';
        ?>
        <div class="designWrapUsers completePage">
            <h1 class="usersDesign">会員登録完了</h1>
            <div class="completeContainer completeContainerPrimary">
                <p>会員登録が完了しました。</p>
                <p>ログインページへお進みください</p>
            </div>
            
            <div class="completeContainer completeContainerSecondary">
                <a href="login.php">ログインページへすすむ</a>
                <a href="cart.php">カートへすすむ</a>
            </div>    
        </div>
        <?php
        require __DIR__ . '/footer.php';
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: register.php');
        exit;
    }

    unset($_SESSION['registerCompleted']);

    if (!isset($_SESSION['register'])) {
        exit('登録情報がありません。入力画面からやり直してください。');
    }

    $token = $_POST['token'] ?? '';
    $sessionToken = $_SESSION['registerToken'] ?? '';

    if (
        !is_string($token) ||
        !is_string($sessionToken) ||
        $sessionToken === '' ||
        !hash_equals($sessionToken, $token)
    ) {
        exit('送信内容を確認できません。入力画面からやり直してください。');
    }

    $register = $_SESSION['register'];

    require_once __DIR__ . '/app/db.php';

    $stmt = $pdo->prepare(
        'INSERT INTO customers (
        name, 
        furigana, 
        postcode_a, 
        postcode_b, 
        address, 
        mail, 
        password 
        ) VALUES (
        :name, 
        :furigana, 
        :postcodeA, 
        :postcodeB, 
        :address, 
        :mail, 
        :password
        )'
    );

    try {
        $stmt->execute([
            'name' => $register['name'],
            'furigana' => $register['furigana'],
            'postcodeA' => $register['postcodeA'],
            'postcodeB' => $register['postcodeB'],
            'address' => $register['address'],
            'mail' => $register['mailaddress'],
            'password' => $register['passwordHash']
        ]);
    } catch (PDOException $e) {
        if (($e->errorInfo[1] ?? null) === 1062) {
            exit('このメールアドレスはすでに登録されています。');
        }

        throw $e;
    }

    unset($_SESSION['register'], $_SESSION['registerToken']);

    $_SESSION['registerCompleted'] = true;

    header('Location: registerComplete.php', true, 303);
    exit;