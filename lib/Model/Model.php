
<?php

require_once(__DIR__ . '/../../config/config.php');
require_once(__DIR__ . '/../functions.php');


class Model{
  public $dbh;
  public function __construct(){
    try {
//       データベース接続
      $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
      $db['dbname'] = ltrim($db['path'], '/');
      $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
      $user = $db['user'];
      $password = $db['pass'];
      $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
      );
      $this->dbh = new PDO($dsn,$user,$password,$options);
    } catch (\PDOException $e) {
      echo $e->getMessage();
      exit;
    }
  }
//   ログイン日時のチェック
  public function checkLoginDate(){
    $sql = "select loginDay from logindateinfo where loginDay = :loginDay and userId = :userId ";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':loginDay' => date('Y-m-d'),
      ':userId' => $_SESSION['me']['userId']
      ]);
    $res = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $res;
  }
// ログイン日時の記録
  public function postLoginDate(){
//     その日初めてのログインなら新しく日時の記録
    $res = $this -> checklogindate();
    if($res === false){
      $sql = "insert into logindateInfo (loginDay, dayWeight, userId) values (:loginDay, :dayWeight, :userId)";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':loginDay' => date('Y-m-d'),
      ':dayWeight' => $_SESSION['me']['nowWeight'],
      ':userId' => $_SESSION['me']['userId']
      ]);
    }
    else{
      $sql = "update logindateinfo set dayWeight = :nowWeight  where loginDay = :loginDay and userId = :userId";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([
        ':nowWeight' => $_SESSION['me']['nowWeight'],
        ':loginDay' => date('Y-m-d'),
        ':userId' => $_SESSION['me']['userId']
        ]);
    }
  }
// ログイン日時の取得（投稿表示の際に使いました）
    public function getLoginDate(){
      $sql = "select * from logindateinfo where userId = :userId order by loginDay desc";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([
        ':userId' => $_SESSION['me']['userId']
        ]);
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
    
    

?>
