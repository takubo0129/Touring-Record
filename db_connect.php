<?php
function connectToDb()
{
    $dbn = 'mysql:dbname=gs13takubo0129_touring_record;charset=utf8mb4;host=mysql3109.db.sakura.ne.jp';
$user = 'gs13takubo0129_touring_record';
$pwd = 'anzu0818';

    try {
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        exit('DB接続エラー: ' . $e->getMessage());
    }
}
?>