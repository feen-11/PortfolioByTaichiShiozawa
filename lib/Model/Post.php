<?php

require_once(__DIR__ . '/Model.php');
require_once(__DIR__ . '/User.php');

class Post extends Model{
//   食事投稿
  public function postFood(){
    $sql = "insert into food (timeflame, foodName, calorie, created, updated, userId) values (:timeflame, :foodName, :calorie, now(), now(), :userId)";
      $stmt = $this->dbh->prepare($sql);
      $res = $stmt->execute([
        ':timeflame' => $_POST['timeflame'],
        ':foodName' => $_POST['foodName'],
        ':calorie' => $_POST['intakeCalorie'],
        ':userId' => $_SESSION['me']['userId']
      ]);
  }
//   トレーニング投稿
  public function postTraining(){
    $sql = "insert into training (trainingName, burnCalorie, created, updated ,userId) values (:trainingName, :burnCalorie, now(), now(), :userId)";
      $stmt = $this->dbh->prepare($sql);
      $res = $stmt->execute([
        ':trainingName' => $_POST['training'],
        ':burnCalorie' => $_POST['burnCalorie'],
        ':userId' => $_SESSION['me']['userId']
      ]);
  }
//   日記投稿
  public function postBody(){
    $res = $this->checkTodayPost();
//     投稿がまだなければ新しく挿入
    if($res === false){
      $sql = "insert into posts (body, created, updated, userId) values (:body, now(), now(), :userId)";
      $stmt = $this->dbh->prepare($sql);
      $res = $stmt->execute([
        ':body' => $_POST['body'],
        ':userId' => $_SESSION['me']['userId']
      ]);
    }
//     既に投稿があればupdateで上書き
    else{
      $sql = "update posts set body = :body, updated = now() where postId = :postId";
        $stmt = $this->dbh->prepare($sql);
        $res = $stmt->execute([
          ':body' => $_POST['body'],
          ':postId' => $res['postId']
        ]);
    }
  }
// 日記読み込み
  public function readPost(){
      $sql = "select * from posts where userId = :userId";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([
        ':userId' => $_SESSION['me']['userId']
      ]);
      return $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
//   食事読み込み
  public function readFood(){
      $sql = "select * from food where userId = :userId";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([
        ':userId' => $_SESSION['me']['userId']
      ]);
      return $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
//   トレーニング読み込み
  public function readTraining(){
      $sql = "select * from training where userId = :userId";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([
        ':userId' => $_SESSION['me']['userId']
      ]);
      return $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
// 当日の日記が既にあるかチェック
  public function checkTodayPost(){
    $sql = "select * from posts where created = :date and userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':date' => date('Y-m-d'),
      ':userId' => $_SESSION['me']['userId']
    ]);
    $res = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $res;
  }
// 合計摂取カロリー計算
  public function getTotalIntakeCalorie(){
    $sql = "select sum(calorie) as totalIntakeCalorie, created from food  where userId = :userId group by created order by created desc ";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':userId' => $_SESSION['me']['userId']
    ]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
  // 合計消費カロリー計算
  public function getTotalBurnCalorie(){
    $sql = "select sum(burnCalorie) as totalBurnCalorie, created from training  where userId = :userId group by created order by created desc ";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':userId' => $_SESSION['me']['userId']
    ]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  
// セッションの更新
  public function updateSESSION(){
    $sql = "select * from users where userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':userId' => $_SESSION['me']['userId']
    ]);
    $user = $stmt->fetch(\PDO::FETCH_ASSOC);
    $_SESSION['me'] = $user;
  }
  
  public function postFoodSample(){
    $res = $this -> checkFoodSample();
    if($res === false){
      $sql = "insert into food (foodName, calorie, created, updated, userId) values ('', 0, now(), now(), :userId)";
        $stmt = $this->dbh->prepare($sql);
        $res = $stmt->execute([
          ':userId' => $_SESSION['me']['userId']
        ]);
    }else{
      return;
    }
  }
  public function postTrainingSample(){
    $res = $this -> checkTrainingSample();
    if($res === false){
      $sql = "insert into training (trainingName, burnCalorie, created, updated ,userId) values ('', 0, now(), now(), :userId)";
        $stmt = $this->dbh->prepare($sql);
        $res = $stmt->execute([
          ':userId' => $_SESSION['me']['userId']
        ]);
    }
    else{
      return;
    }

  }

  public function checkFoodSample(){
    $sql = "select foodName from food where foodName = '' and created = :created and userId = :userId ";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':created' => date('Y-m-d'),
      ':userId' => $_SESSION['me']['userId']
      ]);
    $res = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $res;
  }

  public function checkTrainingSample(){
    $sql = "select trainingName from training where trainingName = '' and created = :created and userId = :userId ";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':created' => date('Y-m-d'),
      ':userId' => $_SESSION['me']['userId']
      ]);
    $res = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $res;
  }

  public function readDetailedFood($id){
    $sql = "select * from food where foodId = :id";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':id' => $id
    ]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }
  public function readDetailedTraining($id){
    $sql = "select * from training where trainingId = :id";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':id' => $id
    ]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function editFood($id){
    $sql = "update food set timeflame = :timeflame, foodName = :foodName, calorie = :calorie, updated = now() where foodId = :foodId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':timeflame' => $_POST['timeflame'],
      ':foodName' => $_POST['foodName'],
      ':calorie' => $_POST['intakeCalorie'],
      ':foodId' => $id
    ]);
  }

  public function deleteFood($id){
    $sql = "delete from food where foodId = :id";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':id' => $id
    ]);
  }
  public function editTraining($id){
    $sql = "update training set trainingName = :trainingName, burnCalorie = :burnCalorie, updated = now() where trainingId = :trainingId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':trainingName' => $_POST['trainingName'],
      ':burnCalorie' => $_POST['burnCalorie'],
      ':trainingId' => $id
    ]);
  }

  public function deleteTraining($id){
    $sql = "delete from training where trainingId = :id";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':id' => $id
    ]);
  }

 
} 
?>
