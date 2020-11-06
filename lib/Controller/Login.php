<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/../Model/User.php');
require_once(__DIR__ . '/../Model/Post.php');
require_once(__DIR__ . '/../Exception/InvalidEmail.php');
require_once(__DIR__ . '/../Exception/InvalidPassword.php');
require_once(__DIR__ . '/../Exception/InvalidToken.php');
require_once(__DIR__ . '/../Exception/ExistsEmail.php');
require_once(__DIR__ . '/../Exception/UnmatchEmailOrPassword.php');

class Login extends Controller{

  public function run(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->loginProcess();
    }
  }
  
// ログイン処理
  public function loginProcess(){
    
    try{
      $this->validate();
    }catch(InvalidToken $e){
      $this->setErrors('token', $e->getMessage());
    }catch(InvalidEmail $e){
      $this->setErrors('email', $e->getMessage());
    }catch(InvalidPassword $e){
      $this->setErrors('password', $e->getMessage());
    }
    // login
    $this->setValues('email', $_POST['email']);
    if($this->hasError()){
      return;
    } else{
      try{
        // login
        $app = new User();
        $user = $app->login();
        $_SESSION['me'] = $user;
        $model = new Model();
        $model->postLoginDate();
        $sample = new Post();
        $sample->postFoodSample();
        $sample->postTrainingSample();
        // redirect
        header('Location: SITE_URL');
      }catch(UnmatchEmailOrPassword $e){
        $this->setErrors('unmatch', $e->getMessage());
      }
    }
  }
// POSTの中身チェック
  public function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      throw new InvalidToken();
    }

    if($_POST['email'] === '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      throw new InvalidEmail();
    }

    if (!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])) {
      throw new InvalidPassword();
    }
  }
}
?>
