<?php
// 商品画像を表示するため、商品のIDと名前を全件取得する。
require_once __DIR__ . '/app/db.php';
require_once __DIR__ . '/app/function.php';
$keyword = $_GET['keyword'] ?? '';
if (!is_string($keyword) || mb_strlen($keyword, 'UTF-8') > 100) {
    http_response_code(400);
    exit('検索キーワードは100文字以内で入力してください。');
}
$keyword = trim($keyword);
if ($keyword === '') {
    $stmt = $pdo->query('SELECT id, name, price FROM products ORDER BY id ASC');
} else {
    $pattern = '%' . strtr($keyword, ['!' => '!!', '%' => '!%', '_' => '!_']) . '%';
    $stmt = $pdo->prepare("SELECT id, name, price FROM products WHERE name LIKE :keyword ESCAPE '!' ORDER BY id ASC");
    $stmt->execute(['keyword' => $pattern]);
}
$products = $stmt->fetchAll();
?>

<?php require __DIR__ . '/header.php'; ?>

<section class="productSection">

    <div class="designWrap productPage">

        <div class="subTitleDesign">
            <h2>商品一覧</h2>
        </div>

        <?php if ($keyword !== ''): ?>
            <p class="searchResult"><?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') ?> の検索結果：<?= count($products) ?>件</p>
        <?php endif; ?>
        <?php if ($products === []): ?>
            <p class="searchResult">該当する商品がありません。</p>
        <?php endif; ?>

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
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="productId" value="<?= (int) $product['id'] ?>">
    <input type="hidden" name="quantity" value="1">
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

                    <form action="cart.php" method="post">
                        <input type="hidden" name="csrfToken" value="<?= htmlspecialchars($_SESSION['csrfToken'], ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="productId" value="<?= (int) $product['id'] ?>">
    <input type="hidden" name="quantity" value="1">
    <button class="cartButton" type="submit">カートに入れる</button>
</form>

                </div>

                <?php endif; ?>

            <?php endforeach; ?>

    </div>

</section>

<?php require __DIR__ . '/footer.php'; ?>
