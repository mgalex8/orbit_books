'use strict';

/* Controllers */

var booksControllers = angular.module('booksControllers', []);

booksControllers.controller('BookListCtrl', ['$scope', '$rootScope', '$location', 'Books',
    function($scope, $rootScope, $location, Books) {
        $scope.books = Books.getAll();
        
        $rootScope.$on('books:updated', function() {
            $scope.books = Books.getAll();
        });
        
        $scope.confirmDelete = function(book) {            
            Books.delete(book);
            $location.path('#/books/');
        }
    }
]);

booksControllers.controller('BookViewCtrl', ['$scope', '$routeParams', '$location', 'Books',    
    function($scope, $routeParams, $location, Books) {        
        Books.get($routeParams.bookId).then(function(book){
            $scope.book = book.data;
        });
        
        $scope.confirmDelete = function(book) {            
            Books.delete(book);
            $location.path('#/books/');
        }
    }
]);

booksControllers.controller('BookAddEditCtrl', ['$scope', '$routeParams', '$http', '$location', 'Books', 'Genres',
    function ($scope, $routeParams, $http, $location, Books, Genres) {
        if ($routeParams.bookId > 0) {
            console.log('edit')
        
            Books.get($routeParams.bookId).then(function(book){
                $scope.book = book.data;
            });
        }
        
        $scope.genres = Genres.query(); 
        //$scope.selectedGenre = $scope.genres[$scope.book.id];
        
        $scope.save = function (book, saveForm){                       
            if (saveForm.$valid){                
                Books.save(book);
                $location.path('/books');                
            }            
        };
    }            
]);
