<!DOCTYPE html>
<html lang=ja>
    <head>
        <meta charset=utf-8>
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
            <div class="designWrap headerDesignPrimary">
                <div class="headerWrapPrimary">
                    <div class="planeContainer">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    
                    <img class="donutsLogo "src="./images/ccdonutsLogo.svg" alt="ドーナツ屋のロゴ">
                    
                    <div class="buyingContainer">
                        <a href="#" type="button">
                            <img src="./images/intoArrow.svg" alt="ログイン">
                            <p>ログイン</p>
                        </a>

                        <a href="#" type="button">
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