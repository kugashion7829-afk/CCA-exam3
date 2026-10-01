<?php
require_once __DIR__ . '/app/db.php';
require_once __DIR__ . '/app/function.php';

$id = $_GET['id'] ?? '';

$stmt = $pdo->prepare(
    'SELECT id, name, price, introduction
    FROM products
    WHERE id = :id'
);

<?php require __DIR__ . '/header.php'; ?>

<div class="designWrap">

    <img src="./images/products/product">

    <div class="detailContainer">

        <p></p>
        
        <hr>

        <p></p>

        <hr>

        <p></p>

        <input>

        <input type="submit" value="カートに入れる">
    </div>
</div>
<?php require __DIR__ . '/footer.php'; ?>
