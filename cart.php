<?php session_start();

    require_once __DIR__ . '/app/db.php';
    require_once __DIR__ . '/app/function.php';

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? 'add';
        $productId = filter_input(
            INPUT_POST,
            'productId',
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );
        
        if (!$productId) {
            exit('商品IDが正しくありません。');
        }

        if ($action === 'delete') {
            unset($_SESSION['cart'][$productId]);

            header('Location: cart.php', true, 303);
            exit;
        }

        $quantity = filter_input(
            INPUT_POST,
            'quantity',
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        if (!$productId || !$quantity) {
            exit('商品IDまたは個数が正しくありません。');
        }
    
        $stmt = $pdo->prepare(
            'SELECT id FROM products WHERE id = :id'
        );

        $stmt->execute(['id' => $productId]);

        $product = $stmt->fetch();

        if ($product === false) {
            exit('商品が見つかりません。');
        }

        if ($action === 'update') {
            if (!isset($_SESSION['cart'][$productId])) {
                exit('カートに商品がありません。');
            }

            $_SESSION['cart'][$productId] = $quantity;
        } else if ($action === 'add') {
            $currentQuantity = $_SESSION['cart'][$productId] ?? 0;
            $_SESSION['cart'][$productId] = $currentQuantity + $quantity;

        } else {
            exit('操作が正しくありません');
        }

        header('Location: cart.php',true,303);
        exit;
    }

    $cartCount = array_sum($_SESSION['cart']);
    $cartTotal = 0;
    $cartItems = [];

    $stmt = $pdo->prepare(
        'SELECT id, name, price FROM products WHERE id = :id'
    );

    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $stmt->execute(['id' => $productId]);
        $product = $stmt->fetch();

        if ($product !== false) {
            $product['quantity'] = $quantity;
            $product['subtotal'] = (int) $product['price'] * $quantity;

            $cartTotal += $product['subtotal'];

            $cartItems[] = $product;
        }
    }

?>

<?php require __DIR__ . '/header.php'; ?>

    <div class="designWrap">
        <?php require __DIR__ . '/app/buying.php'; ?>

        <?php if ($cartItems === []): ?>
            <p class="cartInfo">カートに商品はありません。</p>
        <?php else: ?>

            <?php foreach ($cartItems as $item): ?>

                <?php $imagePath = getProductImagePath((int)$item['id']); ?>

                <article class="cartItem">
                    <img src="<?= htmlspecialchars($imagePath,ENT_QUOTES,"UTF-8") ?>" alt="<?= htmlspecialchars($item['name'],ENT_QUOTES,'UTF-8') ?>">

                    <div class="cartOuterWrap">
                        <h2 class="textDesign cartTextDesign"> <?= htmlspecialchars($item['name'],ENT_QUOTES,'UTF-8') ?> </h2>
                        <hr>

                        <div class="cartInnerWrapPrimary">
                            <p class="textDesign">税込　￥<?= number_format((int)$item['price']) ?></p>
                            
                            <form action="cart.php" method="post">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="productId" value="<?= (int) $item['id'] ?>">

                                <div class="cartInnerWrapSecondary">
                                    <label class="textDesign" for="quantity<?= (int) $item['id'] ?>">数量</label>
                                    <input class="textDesign" type="number" id="quantity<?= (int) $item['id'] ?>" name="quantity" value="<?= (int) $item['quantity'] ?>" min="1" step="1" required>
                                    <span class="textDesign">個</span>
                                </div>

                                <button class="reworkCart cartTextSettings" type="submit">再計算</button>
                            </form>

                            
                        </div>

                        <form class="deleteCart" action="cart.php" method="post">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="productId" value="<?= (int) $item['id'] ?>">

                                <button type="submit cartTextSettings">削除する</button>
                        </form>

                        <hr>

                    </div>

                </article>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php require __DIR__ . '/app/buying.php'; ?>

        <a class="recallProduct cartTextSettings" href="./product.php">買い物を続ける</a>

    </div>

<?php require __DIR__ . '/footer.php'; ?>