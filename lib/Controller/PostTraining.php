<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/../Model/User.php');
require_once(__DIR__ . '/../Model/Post.php');
require_once(__DIR__ . '/../Exception/InvalidToken.php');
require_once(__DIR__ . '/../Exception/InvalidTraining.php');
require_once(__DIR__ . '/../Exception/InvalidBurnCalorie.php');

class PostTraining extends Controller {
  
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

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->postProcess();
    }
  }
// 投稿処理
    public function postProcess(){

      try{
        $this->validate();
      }catch(InvalidToken $e){
        $this->setErrors('token', $e->getMessage());
      }catch(InvalidTraining $e){
        $this->setErrors('training', $e->getMessage());
      }catch(InvalidBurnCalorie $e){
        $this->setErrors('burnCalorie', $e->getMessage());
      }
      // valueのセット
        $this->setValues('training', $_POST['training']);
        $this->setValues('burnCalorie', $_POST['burnCalorie']);

      if($this->hasError()){
        return;
      } else {
          $app = new Post();
          $app->postTraining();
        }  
        // redirect
        header('Location: SITE_URL');
        exit;
    }
    
// POST中身チェック
    public function validate(){
      if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
        throw new InvalidToken();
      }
  
        if(empty($_POST['training'])){
          throw new InvalidTraining();
        };
  
        if(empty($_POST['burnCalorie'])){
          throw new InvalidBurnCalorie();
        };
  
      }

  }

  



?>
