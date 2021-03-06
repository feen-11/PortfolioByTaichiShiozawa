<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/../Model/User.php');
require_once(__DIR__ . '/../Model/Post.php');
require_once(__DIR__ . '/../Exception/InvalidToken.php');
require_once(__DIR__ . '/../Exception/InvalidTimeflame.php');
require_once(__DIR__ . '/../Exception/InvalidFood.php');
require_once(__DIR__ . '/../Exception/InvalidIntakeCalorie.php');

class PostFood extends Controller {
  
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
          }catch(InvalidTimeflame $e){
            $this->setErrors('timeflame', $e->getMessage());
          }catch(InvalidFood $e){
            $this->setErrors('food', $e->getMessage());
          }catch(InvalidIntakeCalorie $e){
            $this->setErrors('intakeCalorie', $e->getMessage());
          }
          // valueのセット
            $this->setValues('foodName', $_POST['foodName']);
            $this->setValues('intakeCalorie', $_POST['intakeCalorie']);
            
          if($this->hasError()){
            return;
          }
          else{
            $app = new Post();
            $app->postFood();
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
      
      if(empty($_POST['timeflame'])){
        throw new InvalidTimeflame();
      };

      if(empty($_POST['foodName'])){
        throw new InvalidFood();
      };

      if(empty($_POST['intakeCalorie'])){
        throw new InvalidIntakeCalorie();
      };

  }


  }

  



?>
