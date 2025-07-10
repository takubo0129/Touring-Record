<?php
// DB接続ファイル読み込み
include('db_connect.php');
$pdo = connectToDb();

// POSTデータの受け取り
$date = $_POST['date'];
$departure = $_POST['departure'];
$destination = $_POST['destination'];
$distance = $_POST['distance'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$cost = $_POST['cost'];
$routeArray = $_POST['route'];            // 🔁 ← 修正ポイント
$route = implode(" → ", $routeArray);    // 🔁 ← 修正ポイント
$rating = $_POST['rating'];
$note = $_POST['note'];
$photo_url = $_POST['photo_url'];
$created_at = date("Y-m-d H:i:s");


// SQL作成（プリペアドステートメント）
$sql = 'INSERT INTO touring_log(
    date, departure, destination, distance, start_time, end_time, cost, route, rating, comment, photo_url, created_at
) VALUES (
    :date, :departure, :destination, :distance, :start_time, :end_time, :cost, :route, :rating, :comment, :photo_url, :created_at
)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':departure', $departure, PDO::PARAM_STR);
$stmt->bindValue(':destination', $destination, PDO::PARAM_STR);
$stmt->bindValue(':distance', $distance, PDO::PARAM_INT);
$stmt->bindValue(':start_time', $startTime, PDO::PARAM_STR);
$stmt->bindValue(':end_time', $endTime, PDO::PARAM_STR);
$stmt->bindValue(':cost', $cost, PDO::PARAM_STR);
$stmt->bindValue(':route', $route, PDO::PARAM_STR);
$stmt->bindValue(':rating', $rating, PDO::PARAM_INT);
$stmt->bindValue(':comment', $note, PDO::PARAM_STR);
$stmt->bindValue(':photo_url', $photo_url, PDO::PARAM_STR);
$stmt->bindValue(':created_at', $created_at, PDO::PARAM_STR);

$routeArray = $_POST['route']; // 配列で受け取る
$route = implode(" → ", $routeArray); // 文字列としてDB保存


// SQL実行
try {
    $stmt->execute();
    header("Location: select.php"); // 成功したら一覧ページへリダイレクト
    exit();
} catch (PDOException $e) {
    exit('SQLエラー: ' . $e->getMessage());
}
?>