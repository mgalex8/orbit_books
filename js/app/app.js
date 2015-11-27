'use strict';

/* App Module */

var booksApp = angular.module('booksApp', [
  'ngRoute',
  'booksControllers',
  'booksFilters',
  'booksServices'
]);

booksApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/books', {
        templateUrl: 'js/app/views/books/books.html',
        controller: 'BookListCtrl'
      }).
      when('/books/view/:bookId', {
        templateUrl: 'js/app/views/books/view.html',
        controller: 'BookViewCtrl'
      }).              
      when('/books/add', {
        templateUrl: 'js/app/views/books/add.html',
        controller: 'BookAddEditCtrl'
      }).
      when('/books/edit/:bookId', {
        templateUrl: 'js/app/views/books/add.html',
        controller: 'BookAddEditCtrl'
      }).            
      
      otherwise({
        redirectTo: '/books'
      });
  }]);
