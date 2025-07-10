<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('db_connect.php');

// DB接続
$pdo = connectToDb();

// idがGETで渡されているか確認
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    exit('不正なIDです');
}

try {
    $stmt = $pdo->prepare("DELETE FROM touring_log WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 削除後に一覧ページへリダイレクト
    header("Location: select.php");
    exit();

} catch (PDOException $e) {
    exit('削除エラー: ' . $e->getMessage());
}
?>

