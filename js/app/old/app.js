'use strict';

/* App Module */

var booksApp = angular.module('booksApp', [
  'ngRoute',
  //'phonecatAnimations',

  'booksControllers',
  'booksFilters',
  'booksServices'
]);

booksApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/books', {
        templateUrl: 'partials/books/books.html',
        controller: 'BookListCtrl'
      }).
      when('/books/view/:bookId', {
        templateUrl: 'partials/books/view.html',
        controller: 'BookViewCtrl'
      }).              
      when('/books/add', {
        templateUrl: 'partials/books/add.html',
        controller: 'BookAddCtrl'
      }).
      when('/books/edit/:bookId', {
        templateUrl: 'partials/books/add.html',
        controller: 'BookEditCtrl'
      }).
      when('/books/delete/:bookId', {
        //templateUrl: 'partials/delete.html',
        controller: 'BookDeleteCtrl'
      }).
      
      otherwise({
        redirectTo: '/books'
      });
  }]);
