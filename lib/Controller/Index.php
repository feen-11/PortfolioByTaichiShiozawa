<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/../Model/User.php');
require_once(__DIR__ . '/../Model/Post.php');
require_once(__DIR__ . '/../Exception/InvalidToken.php');
require_once(__DIR__ . '/../Exception/InvalidTimeflame.php');
require_once(__DIR__ . '/../Exception/InvalidFood.php');
require_once(__DIR__ . '/../Exception/InvalidIntakeCalorie.php');
require_once(__DIR__ . '/../Exception/InvalidTraining.php');
require_once(__DIR__ . '/../Exception/InvalidBurnCalorie.php');

class Index extends Controller {
  
  public function run() {
    if (!$this->loginCheck()) {
      // redirect to login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }
    if (!$this->setUpCheck()) {
      //redirect to setup
      header('Location: ' . SITE_URL . '/setUp.php');
      exit;
    }
    if (!$this->startCheck()) {
      //redirect to start
      header('Location: ' . SITE_URL . '/start.php');
      exit;
    }
  }
// 日記読み込み
  public function readPosts(){
      $app = new Post();
      $posts = $app->readPost();
      return $posts;
  }
// 食事読み込み
  public function readFoods(){
    $app = new Post();
      $posts = $app->readFood();
      return $posts;
  }
// トレーニング読み込み
  public function readTrainings(){
    $app = new Post();
      $posts = $app->readTraining();
      return $posts;
  }
// ログイン日時読み込み
  public function readLoginTimes(){
    $app = new Model();
    return $app->getLoginDate();
  }
// 合計摂取カロリー計算
  public function totalIntakeCalorie(){
    $app = new Post();
    return $app->getTotalIntakeCalorie();
  }
// 合計消費カロリー計算
  public function totalBurnCalorie(){
    $app = new Post();
    return $app->getTotalBurnCalorie();
  }




  }

  



?>
