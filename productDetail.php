<?php
require_once __DIR__ . '/app/db.php';
require_once __DIR__ . '/app/function.php';

$id = $_GET['id'] ?? '';

$stmt = $pdo->prepare(
    'SELECT id, name, price, introduction
    FROM products
    WHERE id = :id'
);

$stmt->execute(['id' => $id]);

$product = $stmt->fetch();
?>

<?php require __DIR__ . '/header.php'; ?>
<?php if ($product !== false): ?>

<div class="designWrap">
    <div class="detailDesign">

        <?php
            $imagePath = getProductImagePath((int) $product['id']);
        ?>

        <img 
            src="<?= htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') ?>"
            alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <div class="detailContainer">

            <p class="detailTitle"> <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?> </p>
            
            <hr>

            <p class="detailDescription">
                <?= htmlspecialchars($product['introduction'], ENT_QUOTES, 'UTF-8') ?>
            </p>

            <hr>

            <p class="detailPrice">
                税込 ￥<?= number_format((int) $product['price']) ?>
            </p>
            
            <div class="detailForm">
                <form action="cart.php" method="post">
                    <input type="hidden" name="productId" value="<?= (int) $product['id'] ?>">

                    <input class=countDesign type="number" id="quantity" name="quantity" value="1" min="1" step="1" required>
                    <label for="quantity">個</label>

                    <button type="submit">カートに入れる</button>
                </form>

                <form action="favorite.php" method="post">
                    <input type="hidden" name="productId" value="<?= (int) $product['id'] ?>">

                    <button type="submit">♡</button>
                </form>
            </div>

        </div>
    </div>
</div>
<?php else: ?>
    <p>商品が見つかりません。</p>
<?php endif; ?>
<?php require __DIR__ . '/footer.php'; ?>
