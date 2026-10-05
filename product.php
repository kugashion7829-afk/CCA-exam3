<?php
// 商品画像を表示するため、商品のIDと名前を全件取得する。
require_once __DIR__ . '/app/db.php';
require_once __DIR__ . '/app/function.php';
$stmt = $pdo->query('SELECT id, name, price FROM products ORDER BY id ASC');
$products = $stmt->fetchAll();
?>

<?php require __DIR__ . '/header.php'; ?>

<section class="productSection">

    <div class="designWrap">

        <div class="subTitleDesign">
            <h2>商品一覧</h2>
        </div>

        <h4 class="textDesign">メインメニュー</h4>

        <div class="productOuterWrap">

            <?php foreach ($products as $product): ?>

                <?php if ((int) $product['id'] <= 6): ?>

                <?php
                // 今取り出している商品のIDから画像パスを作る
                $imagePath = getProductImagePath((int) $product['id']);
                ?>
                
                <div class="productInnerWrap">
                     <a href="productDetail.php?id=<?= (int) $product['id']?>">
                        <div class="productImageContainer">
                            <img
                                src="<?= htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') ?>"
                                alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>"
                            >
                        </div>

                   
                        <p class="productCardName textDesign">
                            <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </a>

                    <p class="rankingProductPrice textDesign">
                        税込 ￥<?= number_format((int) $product['price']) ?>
                    </p>

                    <form action="cart.php" method="post">
                        <input type="hidden" name="csrfToken" value="<?= htmlspecialchars($_SESSION['csrfToken'], ENT_QUOTES, 'UTF-8') ?>">
                        <input type="hidden" name="productId" value="<?= (int) $product['id'] ?>">

                        <button class="cartButton" type="submit">カートに入れる</button>
                    </form>

                </div>

                <?php endif; ?>

            <?php endforeach; ?>

        </div>

        <h4>バラエティセット</h4>

            <div class="productOuterWrap">

            <?php foreach ($products as $product): ?>

                <?php if ((int) $product['id'] >= 7): ?>

                <?php
                // 今取り出している商品のIDから画像パスを作る
                $imagePath = getProductImagePath((int) $product['id']);
                ?>
                
                <div class="productInnerWrap">
                    <a href="productDetail.php?id=<?= (int) $product['id']?>">
                        <div class="productImageContainer">
                            <img
                                src="<?= htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') ?>"
                                alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>"
                            >
                        </div>

                        <p class="productCardName textDesign">
                            <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </a>

                    <p class="rankingProductPrice textDesign">
                        税込 ￥<?= number_format((int) $product['price']) ?>
                    </p>

                    <input class="cartButton" type="submit" value="カートに入れる">

                </div>

                <?php endif; ?>

            <?php endforeach; ?>

    </div>

</section>

<?php require __DIR__ . '/footer.php'; ?>
