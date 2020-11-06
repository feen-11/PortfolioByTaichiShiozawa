<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/../Model/User.php');
require_once(__DIR__ . '/../Model/Post.php');
require_once(__DIR__ . '/../Exception/InvalidToken.php');
require_once(__DIR__ . '/../Exception/InvalidBody.php');


class PostBody extends Controller {
  
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
//   投稿処理
    public function postProcess(){

      try{
        $this->validate();
      }catch(InvalidToken $e){
        $this->setErrors('token', $e->getMessage());
      }catch(InvalidBody $e){
        $this->setErrors('body', $e->getMessage());
      }

      $this->setValues('body', $_POST['body']);
          if($this->hasError()){
            return;
          }
          else{
            $app = new Post();
            $app->postBody();
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
  
        if(empty($_POST['body']) ||mb_strlen($_POST['body']) > 191){
          throw new InvalidBody();
        };
  
      }

      public function checkPost(){
        $app = new Post();
        $post = $app->checkTodayPost();
        return $post;
      }

  }

  



?>
