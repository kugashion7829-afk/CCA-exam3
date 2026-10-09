<?php
require_once __DIR__ . '/app/session.php';

require_once __DIR__ . '/app/db.php';
require_once __DIR__ . '/app/function.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if (!$id) {
    http_response_code(400);
    require __DIR__ . '/header.php';
    echo '<p>商品IDが正しくありません。</p>';
    require __DIR__ . '/footer.php';
    exit;
}

$stmt = $pdo->prepare(
    'SELECT id, name, price, introduction
    FROM products
    WHERE id = :id'
);

$stmt->execute(['id' => $id]);

$product = $stmt->fetch();
if ($product === false) http_response_code(404);
?>

<?php require __DIR__ . '/header.php'; ?>
<?php if ($product !== false): ?>

<div class="designWrap productDetailPage">
    <div class="detailDesign">

        <?php
            $imagePath = getProductImagePath((int) $product['id']);
        ?>

        <img id="detailHeroImage" 
            src="<?= htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') ?>"
            alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <div class="detailContainer">

            <p class="detailTitle detailSettings"> <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?> </p>
            
            <hr>

            <p class="detailDescription detailSettings">
                <?= htmlspecialchars($product['introduction'], ENT_QUOTES, 'UTF-8') ?>
            </p>

            <hr>

            <p class="detailPrice detailSettings">
                税込 ￥<?= number_format((int) $product['price']) ?>
            </p>
            
            <div class="detailForm">
                <form class="formDesign" action="cart.php" method="post">
                    <input type="hidden" name="csrfToken" value="<?= htmlspecialchars($_SESSION['csrfToken'], ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="productId" value="<?= (int) $product['id'] ?>">

                    <input class=countDesign type="number" id="quantity" name="quantity" value="1" min="1" max="999" step="1" required>
                    <label class="detailSettings" for="quantity">個</label>

                    <button class="cartButton " type="submit">カートに入れる</button>
                </form>

                <button class="favoriteDetail" type="button" disabled aria-label="お気に入り（準備中）" title="お気に入り機能は準備中です">
                    <img src="./images/heart.svg" alt="">
                </button>
            </div>

        </div>
    </div>
</div>
<?php else: ?>
    <p>商品が見つかりません。</p>
<?php endif; ?>
<?php require __DIR__ . '/footer.php'; ?>
