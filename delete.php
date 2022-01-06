<?php
//データ受け取り
$id = intval($_POST['id']);
$pass = $_POST['pass'];

//必須項目チェック
if ($id == '' || $pass == ''){
  header('Location: keijiban.php');
  exit();
}

//データベースに接続
$dsn = 'mysql:host=mysql1.php.xdomain.ne.jp;dbname=syouchan12_semi;chaeset=utf8';
$user = 'syouchan12_host';
$password = 'syoutarou123'; //semiplayerに設定したパスワード

try {
  $db = new PDO($dsn, $user, $password);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  //プリペアドステートメントの作成
  $stmt = db->prepare(
    "DELETE FROM keijiban WHERE id=:id AND pass=:pass"
  );
  //パラメータを割り当て
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
  //クエリの実行
  $stmt->execute();
} catch(PDOException $e){
  echo "エラー:" . $e->getMessage();
}
header("Location: keijiban.php");
exit();
 ?>
