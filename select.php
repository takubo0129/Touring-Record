<?php
include('db_connect.php');
$pdo = connectToDb();

// データ取得
$sql = 'SELECT * FROM touring_log ORDER BY date DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>記録一覧 | Touring Record</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>🗂 ツーリング記録一覧</h1>
  </header>
  <div class="container">
    <?php if (count($records) === 0): ?>
      <p>まだ記録がありません。</p>
    <?php else: ?>
      <?php foreach ($records as $r): ?>
        <div class="record">
          <h2><?= htmlspecialchars($r['departure']) ?> → <?= htmlspecialchars($r['destination']) ?></h2>
          <div class="meta">
            日付：<?= htmlspecialchars($r['date']) ?> ｜ 距離：<?= htmlspecialchars($r['distance']) ?>km ｜ 満足度：<?= str_repeat("★", (int)$r['rating']) ?>
          </div>
          <?php if (!empty($r['photo_url'])): ?>
            <div class="photo">
              <img src="<?= htmlspecialchars($r['photo_url']) ?>" alt="ツーリング写真" class="photo">
            </div>
          <?php endif; ?>
          <div class="note">
            <p><strong>ルート：</strong><?= nl2br(htmlspecialchars($r['route'])) ?></p>
            <p><strong>費用：</strong><?= htmlspecialchars($r['cost']) ?> 円</p>
            <p><strong>出発〜帰宅：</strong> <?= htmlspecialchars($r['start_time']) ?> - <?= htmlspecialchars($r['end_time']) ?></p>
            <p><strong>メモ：</strong><?= nl2br(htmlspecialchars($r['comment'])) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</body>
</html>
