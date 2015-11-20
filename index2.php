<!doctype html>
<html lang="en" ng-app="phonecatApp">
<head>
  <meta charset="utf-8">
  <title>Google Phone Gallery</title>
  <link rel="stylesheet" href="/css/bootstrap.css">
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/css/animations.css">

  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js" type="text/javascript"></script>
  <script src="/js/angular/angular-animate/angular-animate.js"></script>
  <script src="/js/angular/angular-route/angular-route.js"></script>
  <script src="/js/angular/angular-resource/angular-resource.js"></script>
  <script src="/js/app.js"></script>
  <script src="/js/animations.js"></script>
  <script src="/js/controllers.js"></script>
  <script src="/js/filters.js"></script>
  <script src="/js/services.js"></script>
</head>
<body>

  <div class="view-container">
    <div ng-view class="view-frame"></div>
  </div>

</body>
</html>
