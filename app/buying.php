<div class="cartContainer">
    
    <p>現在 商品<?= (int) $cartCount ?>点</p>

    <p>ご注文小計：税込<span>￥<?= number_format($cartTotal) ?></span></p>
    
    <input type="submit" value="購入確認へ進む">
</div>