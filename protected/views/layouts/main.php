<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>        
    <link rel='stylesheet' href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/bootstrap.min.css" type='text/css' />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/font-awesome.min.css">
    <link rel='stylesheet' href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/style.css" type='text/css' />
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/script.js"></script>
    <link rel=""
</head>
<body>
      
        <?php echo $content; ?>

</body>
</html>
      
