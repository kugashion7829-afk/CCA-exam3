-- C.C.Donuts 演習：配布SQLからの変更まとめ
-- 作成日：2026-10-07
-- 対象：配布SQLで作成済みの ccdonuts データベース
-- このファイルはDBやテーブルを削除しません。
-- 現在のDBを直接検査した結果ではなく、会話で行った変更の記録です。
-- 既に同じ型へ変更済みでも、以下の定義は同じです。
-- 実行前にDBをエクスポートし、構造変更が可能な管理者で実行してください。
-- 配布SQLそのものは DROP DATABASE を含むため、既存DBへ再実行しないでください。

USE `ccdonuts`;

-- 1. パスワードのハッシュを保存できる長さに変更
-- PHPでは password_hash() で生成した値を保存します。
-- 型変更だけでは既存の平文パスワードはハッシュ化されません。
ALTER TABLE `customers`
    MODIFY COLUMN `password` VARCHAR(255) NOT NULL;

-- 2. 郵便番号を数値ではなく文字列として保存
-- 例：「012」「0034」の先頭の0を保持するための変更です。
-- 既にINTとして保存して失われた先頭の0は、型変更だけでは復元されません。
ALTER TABLE `customers`
    MODIFY COLUMN `postcode_a` CHAR(3) NOT NULL,
    MODIFY COLUMN `postcode_b` CHAR(4) NOT NULL;

-- 3. 権限設定の記録（必要な場合だけコメントを外して管理者で実行）
-- 配布SQLと同じ、ローカルXAMPPの演習用アカウントです。
-- CREATE USER IF NOT EXISTS は既存ユーザーのパスワードを変更しません。
-- CREATE USER IF NOT EXISTS 'ccStaff'@'localhost' IDENTIFIED BY 'ccDonuts';
-- GRANT ALL PRIVILEGES ON `ccdonuts`.* TO 'ccStaff'@'localhost';
-- SHOW GRANTS FOR 'ccStaff'@'localhost';
-- CREATE USER / GRANT の後に通常 FLUSH PRIVILEGES は必要ありません。

-- 4. 障害対応の記録：MariaDBの権限テーブル mysql.db の破損
-- 通常の構造変更ではないため、以下は実行しません。
-- 過去には CHECK TABLE で Corrupt が検出され、修復後に接続できました。
-- 再発時は診断結果を確認し、サーバー停止中のデータディレクトリの
-- バックアップを確保したうえで、管理者が必要な操作だけを行ってください。
-- CHECK TABLE mysql.db;
-- REPAIR TABLE mysql.db;
-- FLUSH PRIVILEGES;

-- 5. 確認用（読み取りのみ）
SHOW COLUMNS FROM `customers`;

-- 補足：
-- customers.mail の UNIQUE 制約は配布SQLに元からあります。
-- カート、ログイン状態、登録確認用情報のテーブルは追加していません。
-- これらはPHPのセッションで保持します。
-- 会員データの追加は登録画面から行うため、INSERT文は含めていません。