<?php

require_once(__DIR__ . '/Model.php');
require_once(__DIR__ . '/../Exception/ExistsEmail.php');
require_once(__DIR__ . '/../Exception/UnmatchEmailOrPassword.php');

class User extends Model{
// ユーザー登録
  public function userCreate(){
      $sql = "insert into users (email, name, password, created, updated) values (:email, :name, :password, now(), now())";
      $stmt = $this->dbh->prepare($sql);
      $res = $stmt->execute([
        ':email' => $_POST['email'],
        ':name' => $_POST['name'],
        ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
      ]);
  }
// ログイン処理
  public function login(){
    $sql = 'select * from users where email = :email';
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':email' => $_POST['email']
    ]); 
    $user = $stmt->fetch(\PDO::FETCH_ASSOC);
      if(password_verify($_POST['password'],$user['password'])){
        return $user;
      }else{
        throw new UnmatchEmailOrPassword();
      }
  }
// 初期設定①
  public function setUp(){
    $sql = "update users set age = :age, sex = :sex, height = :height, weight = :weight, nowWeight =     :nowWeight, updated = now() where userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':age' => $_POST['age'],
      ':sex' => $_POST['sex'],
      ':height' => $_POST['height'],
      ':weight' => $_POST['weight'],
      ':nowWeight' => $_POST['weight'],
      ':userId' => $_SESSION['me']['userId']
    ]);

    // セッションの更新
    $this->updateSESSION();

  }
//   初期設定②
  public function setGoal(){
    $sql = 'update users set declaration = :declaration, goalWeight = :goalWeight, updated = now() where userId = :userId';
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':declaration' => $_POST['declaration'],
      ':goalWeight' => $_POST['goalWeight'],
      ':userId' => $_SESSION['me']['userId']
    ]);

    // セッションの更新
    $this->updateSESSION();
    }
// 体重記録処理
  public function postWeight(){
    $sql = "update users set nowWeight = :nowWeight, updated = now() where userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':nowWeight' => $_POST['nowWeight'],
      ':userId' => $_SESSION['me']['userId']
    ]);
    // セッションの更新
    $this->updateSESSION();
    $model = new Model();
    $model->postLoginDate();
  }
  
// ユーザー情報編集
  public function userEdit(){
    $sql = "update users set name = :name, email = :email, age = :age, height = :height, weight = :weight, nowWeight = :nowWeight, goalWeight = :goalWeight, declaration = :declaration, updated = now() where userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':name' => $_POST['name'],
      ':email' => $_POST['email'],
      ':age' => $_POST['age'],
      ':height' => $_POST['height'],
      ':weight' => $_POST['weight'],
      ':nowWeight' => $_POST['nowWeight'],
      ':goalWeight' => $_POST['goalWeight'],
      ':declaration' => $_POST['declaration'],
      ':userId' => $_SESSION['me']['userId']
    ]);
    // セッションの更新
    $this->updateSESSION();
    $model = new Model();
    $model->postLoginDate();
  }

  public function postUser($userId){
    $sql = "select name from users where userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':userId' => $userId
    ]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }
// セッション更新処理
  public function updateSESSION(){
    $sql = "select * from users where userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':userId' => $_SESSION['me']['userId']
    ]);
    $user = $stmt->fetch(\PDO::FETCH_ASSOC);
    $_SESSION['me'] = $user;
  }


} 
?>
