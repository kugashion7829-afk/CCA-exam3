<?php
require_once __DIR__ . '/app/session.php';

if (!isset($_SESSION['customer'])) {
    $ANNOUNCE = 'ゲスト';
} else {
    $ANNOUNCE = $_SESSION['customer']['name'];
}

?>
<!DOCTYPE html>
<html lang=ja>
    <head>
        <meta charset=UTF-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./common/reset.css">
        <link rel="stylesheet" href="./styles/style.css">
        <title>CCDonut</title>
    </head>
    
    <body>
        <header>
                             
            <div class="menuWrap" id="drawerMenu" inert>
                <img class="menuLogo" src="./images/ccdonutsLogo.svg" alt="ドーナツロゴ">
                <nav class="menu">
                    <ul>
                        <li><a href="./index.php">TOP</a></li>
                        <li><a href="./product.php">商品一覧</a></li>
                        <li><a href="#">よくある質問</a></li>
                        <li><a href="#">問い合わせ</a></li>
                        <li><a href="#">当サイトのポリシー</a></li>
                    </ul>
                </nav>
                <button class="close">
                    <picture>
                        <source media="(max-width: 768px)" srcset="./images/crossSP.svg">
                        <img class="closeButton" src="./images/cross.svg" alt="閉じるボタン">
                    </picture>
                </button>
            </div>

            <div class="designWrap headerDesignPrimary">
                <div class="headerWrapPrimary">
                    <button class="open" type="button" aria-label="メニューを開く" aria-expanded="false" aria-controls="drawerMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <img class="donutsLogo "src="./images/ccdonutsLogo.svg" alt="ドーナツ屋のロゴ">
                    
                    <div class="buyingContainer">
                        <?php if (isset($_SESSION['customer'])): ?>
                            <a href="./account.php">
                                <img src="./images/intoArrow.svg" alt="">
                                <p>アカウント</p>
                            </a>
                        <?php else: ?>
                            <a href="./login.php">
                                <img src="./images/intoArrow.svg" alt="">
                                <p>ログイン</p>
                            </a>
                        <?php endif; ?>

                        <a href="./cart.php" type="button">
                            <img src="./images/cart.svg" alt="カート">
                            <p>カート</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="designWrap headerDesignSecondary">
                <div class="headerWrapSecondary">
                    <form action="product.php" method="get">
                        <button type="submit" aria-label="検索">

                            <img src="./images/lens.svg" alt="虫眼鏡">
                        
                        </button>
                        <input type="search" id="searchKeyword" name="keyword" aria-label="商品検索">
                    </form>
                </div>
            </div>
            
            <div class="announce breadcrumb">
                <p>ようこそ</p>
                <p><?= htmlspecialchars($ANNOUNCE, ENT_QUOTES, 'UTF-8') ?>様</p>
            </div>
        
        </header>

        <main>