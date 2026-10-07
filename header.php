<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
                             
            <div class="menuWrap">
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
                    <img class="closeButton" src="./images/cross.svg" alt="閉じるボタン">
                </button>
            </div>

            <div class="designWrap headerDesignPrimary">
                <div class="headerWrapPrimary">
                    <button class="open">
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
                    <form action="" method="post">
                        <button type="submit" aria-label="検索">

                            <img src="./images/lens.svg" alt="虫眼鏡">
                        
                        </button>
                        <input type="search" id="searchKeyword" name="keyword" aria-label="商品検索">
                    </form>
                </div>
            </div>
        </header>

        <main>