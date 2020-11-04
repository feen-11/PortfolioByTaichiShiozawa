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
      // login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }
    if (!$this->setUpCheck()) {
      // setup
      header('Location: ' . SITE_URL . '/setUp.php');
      exit;
    }
    if (!$this->startCheck()) {
      // start
      header('Location: ' . SITE_URL . '/start.php');
      exit;
    }
  }

  public function readPosts(){
      $app = new Post();
      $posts = $app->readPost();
      return $posts;
  }

  public function readFoods(){
    $app = new Post();
      $posts = $app->readFood();
      return $posts;
  }

  public function readTrainings(){
    $app = new Post();
      $posts = $app->readTraining();
      return $posts;
  }

  public function readLoginTimes(){
    $app = new Model();
    return $app->getLoginDate();
  }

  public function totalIntakeCalorie(){
    $app = new Post();
    return $app->getTotalIntakeCalorie();
  }

  public function totalBurnCalorie(){
    $app = new Post();
    return $app->getTotalBurnCalorie();
  }




  }

  



?>