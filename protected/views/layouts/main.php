<!doctype html>
<html lang="en" ng-app="booksApp">
<head>
  <meta charset="utf-8">
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <link rel="stylesheet" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/bootstrap.min.css">    
  <link rel="stylesheet" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/font-awesome.min.css">

  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>  
  <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/angular/angular.js"></script>
  <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/angular/angular-animate/angular-animate.js"></script>
  <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/angular/angular-route/angular-route.js"></script>
  <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/angular/angular-resource/angular-resource.js"></script>
  <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/angular/ng-upload/ng-upload.min.js"></script>
  <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/angular/pagination/dirPagination.js"></script>
  <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/app/app.js"></script>  
  <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/app/animations.js"></script>
  <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/app/controllers.js"></script>
  <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/app/filters.js"></script>
  <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/app/services.js"></script>
  
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <!--Body content-->
      
      <?php echo $content; ?>
      
    </div>
    <div class="col-md-1"></div>
  </div>
</div>


</body>
</html>
