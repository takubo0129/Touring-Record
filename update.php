<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('db_connect.php');

$pdo = connectToDb(); // ← 追加！

// POSTで受け取ったデータ
$id = (int)($_POST['id'] ?? 0);
$departure = $_POST['departure'] ?? '';
$destination = $_POST['destination'] ?? '';
$date = $_POST['date'] ?? '';
$start_time = $_POST['start_time'] ?? '';
$end_time = $_POST['end_time'] ?? '';
$duration = $_POST['duration'] ?? '';
$cost = $_POST['cost'] ?? '';
$distance = $_POST['distance'] ?? '';
$route = $_POST['route'] ?? '';
$comment = $_POST['comment'] ?? '';
$rating = $_POST['rating'] ?? '';

if ($id <= 0) {
    exit('不正なIDです');
}

try {
    $sql = "UPDATE touring_log SET 
        departure = :departure,
        destination = :destination,
        date = :date,
        start_time = :start_time,
        end_time = :end_time,
        duration = :duration,
        cost = :cost,
        distance = :distance,
        route = :route,
        comment = :comment,
        rating = :rating
        WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':departure', $departure);
    $stmt->bindValue(':destination', $destination);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':start_time', $start_time);
    $stmt->bindValue(':end_time', $end_time);
    $stmt->bindValue(':duration', $duration);
    $stmt->bindValue(':cost', $cost);
    $stmt->bindValue(':distance', $distance);
    $stmt->bindValue(':route', $route);
    $stmt->bindValue(':comment', $comment);
    $stmt->bindValue(':rating', $rating);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    header("Location: select.php");
    exit();

} catch (PDOException $e) {
    exit('更新エラー: ' . $e->getMessage());
}
?>
