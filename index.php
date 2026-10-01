<?php
// DBに接続し、表示確認用の商品を1件取得する（売上順位ではなくID順）。
require_once __DIR__ . '/app/db.php';
require_once __DIR__ . '/app/function.php';
$stmt = $pdo->query('SELECT id, name, price FROM products ORDER BY id ASC LIMIT 1');
$rankingProduct = $stmt->fetch();
?>
        <?php require __DIR__ . '/header.php'; ?>
        <?php require __DIR__ . '/announce.php'; ?>

        <div class="heroImageWrap">
                <img src="./images/HeroImage.jpg" alt="ドーナツを分け合う写真">
        </div>

        <div class="designWrap sectionDesignWrap">
                
                <section class="forumSection">

                        <div class="imageContainerPrimary" type="button">
                               
                                <a href="#">
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

        <div class="designWrap">

                <section class="rankingSection">
                        <h2>人気ランキング</h2>
                        <p>表示確認用：商品ID順の仮ランキングです。</p>

                        <?php if ($rankingProduct !== false): ?>
                                <article class="rankingCard">
                                        <p>1位（仮）</p>
                                        <h3><?= htmlspecialchars($rankingProduct['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                                        <p><?= number_format((int) $rankingProduct['price']) ?>円</p>
                                </article>
                        <?php else: ?>
                                <p>商品が登録されていません。</p>
                        <?php endif; ?>
                </section>

        </div>
        
        <?php require __DIR__ . '/footer.php'; ?>

        <!-- 
        Webプログラミング演習3 -CCDonuts 
        
        コード作成：久我 嗣生
        素材の権利者：中央キャリアアップアカデミー
        制作目的：授業課題
        -->