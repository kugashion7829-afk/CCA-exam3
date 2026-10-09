<?php require __DIR__ . '/header.php'; ?>

<div class="designWrapUsers"> 
    <h1 class="usersDesign">会員登録</h1>

    <form class="registerPage" action="registerComfirm.php" method="post">
        <input type="hidden" name="csrfToken" value="<?= htmlspecialchars($_SESSION['csrfToken'], ENT_QUOTES, 'UTF-8') ?>">
        <div class="registerContainer">
            <label for="name">お名前<span>（必須）</span></label>
            <input type="text" id="name" name="name" maxlength="100" autocomplete="name" placeholder="ドーナツ太郎" required>
        </div>

        <div class="registerContainer">
            <label for="furigana">お名前（フリガナ）<span>（必須）</span></label>
            <input type="text" id="furigana" name="furigana" maxlength="100" placeholder="ドーナツタロウ" required>
        </div>

        <div class="registerContainer">
            <label for="postcodeA">郵便番号<span>（必須）</span></label>
            <div class="postcodeContainer">
                <input class="postcodeA" type="text" id="postcodeA" name="postcodeA" inputmode="numeric" maxlength="3" pattern="[0-9]{3}" aria-label="郵便番号の上3桁" placeholder="123" required>
                <input class="postcodeB" type="text" id="postcodeB" name="postcodeB" inputmode="numeric" maxlength="4" pattern="[0-9]{4}" aria-label="郵便番号の下4桁" placeholder="4567" required>
            </div>            
        </div>

        <div class="registerContainer">
            <label for="address">住所<span>（必須）</span></label>
            <input type="text" id="address" name="address" maxlength="200" autocomplete="street-address" placeholder="千葉県〇〇市中央1-1-1" required>
        </div>

        <div class="registerContainer">
            <label for="mailaddress">メールアドレス<span>（必須）</span></label>
            <input type="email" id="mailaddress" name="mailaddress" maxlength="100" autocomplete="email" placeholder="123@gmail.com" required>
        </div>

        <div class="registerContainer">
            <label for="mailConfirm">メールアドレス確認用<span>（必須）</span></label>
            <input type="email" id="mailConfirm" name="mailConfirm" maxlength="100" placeholder="123@gmail.com" required>
        </div>

        <div class="registerContainer">
            <label for="passwordA">パスワード<span>（必須）</span></label>
            <p>半角英数字8文字以上20文字以内で入力してください。※記号の使用はできません</p>
            <input type="password" id="passwordA" name="passwordA" minlength="8" maxlength="20" pattern="[A-Za-z0-9]{8,20}" autocomplete="new-password" placeholder="123456abcd" required>
        </div>

        <div class="registerContainer">
            <label for="passwordB">パスワード確認用<span>（必須）</span></label>
            <input type="password" id="passwordB" name="passwordB" minlength="8" maxlength="20" autocomplete="new-password" placeholder="123456abcd" required>
        </div>
        
        <button class="submitButton" type="submit">入力を確認する</button>

    </form>

</div>


<?php require __DIR__ . '/footer.php'; ?>