'use strict';

/* App Module */

var booksApp = angular.module('booksApp', [
  'ngRoute',
  'ngUpload',
  'angularUtils.directives.dirPagination',
  'booksControllers',  
  'booksFilters',
  'booksServices',  
]);

booksApp.directive('uploadDirective', function (httpUploadFactory) {
    return {
        restrict: 'A',
        scope: true,        
        link: function (scope, element, attr) {
            element.bind('change', function () {
                var formData = new FormData();                
                formData.append('file', element[0].files[0]);
                httpUploadFactory('api/upload', formData, function (callback) {
                    // загрузил файл на сервер через директиву
                    // но так и не смог свять полученные данные с контроллером BookAddEditCtrl
                    // соответственно информация о связанном изображении для книги не попадает в БД
                    // Здесь простой вывод в консоль
                    console.log(callback);                    
                });
            });

        }
    };
});

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
