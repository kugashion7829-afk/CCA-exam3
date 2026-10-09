<?php
// DBに接続し、表示確認用の商品を1件取得する（売上順位ではなくID順）。
require_once __DIR__ . '/app/db.php';
require_once __DIR__ . '/app/function.php';
$stmt = $pdo->query(
    'SELECT id, name, price FROM products ORDER BY id ASC LIMIT 6'
);

$rankingProducts = $stmt->fetchAll();
?>
        <?php require __DIR__ . '/header.php'; ?>

        <div class="heroImageWrap">
                <img src="./images/HeroImage.jpg" alt="ドーナツを分け合う写真">
        </div>

        <div class="designWrap sectionDesignWrap topPage">
                
                <section class="forumSection">

                        <div class="imageContainerPrimary" type="button">
                               
                                <a href="productDetail.php?id=5">
                                        <img src="./images/newSales.jpg" alt="新商品">
                                        <p class="newSalesText">サマーシトラス</p>
                                        <div><p>新商品</p></div>
                                </a>
                        
                                <a href="#">
                                        <img src="./images/donutsLife.jpg" alt="ドーナツのある生活">
                                        <p class="donutsLifeText">ドーナツのある生活</p>
                                </a>

                        </div>

                        <div class="imageContainerSecondary">
                                
                                <a href="product.php">
                                        <img src="./images/choiceDonuts.jpg" alt="ドーナツ一覧">
                                        <p>商品一覧</p>
                                </a>            
                        
                        </div>
                
                </section>

        </div>

        <section class="philosophySection">                        
                
                <div class="philosophy">
                        <span></span>
                        <div class="philosophyPrimal">
                                <h2>philosophy</h2>
                                <p>私たちの信念</p>
                        </div>

                        <div class="philosophySecond">
                                <h3>"Creating Conenections"</h3>
                                <p>「ドーナツでつながる」</p>
                
                        </div>
                </div>
                
        </section>


        <section class="rankingSection">
                <div class="designWrap">
                        <h2>人気ランキング</h2>
                        <article class="rankingCard">

                                <?php foreach ($rankingProducts as $index => $product): ?>
                                        <?php $imagePath = getProductImagePath((int) $product['id']); ?>
                                        
                                                <div class="rankingContainer">
                                                                <p class="rankingNumber rankingNumber<?= $index + 1 ?>"><?= $index + 1 ?></p>
                                                       
                                                        <a href="productDetail.php?id=<?= (int) $product['id']?>">
                                                                <img src="<?= htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>">

                                                                <p class="productCardName textDesign"> <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?> </p>
                                                        </a>

                                                        <p class="rankingProductPrice textDesign">税込 ￥<?= number_format((int) $product['price']) ?></p>

                                                        <form action="cart.php" method="post">
                        <input type="hidden" name="csrfToken" value="<?= htmlspecialchars($_SESSION['csrfToken'], ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="productId" value="<?= (int) $product['id'] ?>">
    <input type="hidden" name="quantity" value="1">
    <button class="cartButton" type="submit">カートに入れる</button>
</form>
                                                </div>

                                <?php endforeach; ?>
                        </article>
                </div>
        </section>

        
        <?php require __DIR__ . '/footer.php'; ?>

        <!-- 
        Webプログラミング演習3 -CCDonuts 
        
        コード作成：久我 嗣生
        素材の権利者：中央キャリアアップアカデミー
        制作目的：授業課題
        -->