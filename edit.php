<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('db_connect.php');

$pdo = connectToDb(); // 追加：DB接続の実行

// IDの取得とチェック
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    exit('不正なIDです');
}

// 対象のレコード取得（テーブル名修正済み）
$stmt = $pdo->prepare("SELECT * FROM touring_log WHERE id = ?");
$stmt->execute([$id]);
$record = $stmt->fetch();

if (!$record) {
    exit('データが見つかりません');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="stylesheet" href="style.css">

    <meta charset="UTF-8">
    <title>編集 - Touring Record</title>
</head>
<body>
    <h1>編集フォーム</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($record['id']) ?>">

        出発地：<input type="text" name="departure" value="<?= htmlspecialchars($record['departure']) ?>"><br>
        目的地：<input type="text" name="destination" value="<?= htmlspecialchars($record['destination']) ?>"><br>
        日付：<input type="date" name="date" value="<?= htmlspecialchars($record['date']) ?>"><br>
        出発時刻：<input type="time" name="start_time" value="<?= htmlspecialchars($record['start_time']) ?>"><br>
        帰宅時刻：<input type="time" name="end_time" value="<?= htmlspecialchars($record['end_time']) ?>"><br>
        所要時間：<input type="text" name="duration" value="<?= htmlspecialchars($record['duration']) ?>"><br>
        費用：<input type="text" name="cost" value="<?= htmlspecialchars($record['cost']) ?>"><br>
        距離：<input type="text" name="distance" value="<?= htmlspecialchars($record['distance']) ?>"><br>
        ルート：<input type="text" name="route" value="<?= htmlspecialchars($record['route']) ?>"><br>
        メモ：<textarea name="comment"><?= htmlspecialchars($record['comment']) ?></textarea><br>
        満足度（1〜5）：<input type="number" name="rating" min="1" max="5" value="<?= htmlspecialchars($record['rating']) ?>"><br>

        <button type="submit">更新する</button>
    </form>
</body>
</html>

