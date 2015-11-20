'use strict';

/* App Module */

var booksApp = angular.module('phonecatApp', [
  'ngRoute',
  'phonecatControllers',  
  'phonecatServices'
]);

booksApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/books', {
        templateUrl: 'partials/phone-list.html',
        controller: 'PhoneListCtrl'
      }).
      when('/phones/:phoneId', {
        templateUrl: 'partials/phone-detail.html',
        controller: 'PhoneDetailCtrl'
      }).
      otherwise({
        redirectTo: '/phones'
      });
  }]);
