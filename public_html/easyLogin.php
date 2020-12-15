<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../lib/Model/User.php');
require_once(__DIR__ . '/../lib/Model/Post.php');

  $app = new User();
  $user = $app->easyLogin();
  $_SESSION['me'] = $user;
  $model = new Model();
  $model->postLoginDate();
  $sample = new Post();
  $sample->postFoodSample();
  $sample->postTrainingSample();
  // redirect
  header('Location: SITE_URL');

?>