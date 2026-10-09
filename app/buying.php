<div class="cartContainer">
    
    <p>現在 商品<?= (int) $cartCount ?>点</p>

    <p>ご注文小計：税込<span>￥<?= number_format($cartTotal) ?></span></p>
    
    <input type="button" value="購入確認（準備中）" disabled>
</div>