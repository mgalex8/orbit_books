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
        }
    }
]);

booksControllers.controller('BookViewCtrl', ['$scope', '$routeParams', '$location', 'Books',    
    function($scope, $routeParams, $location, Books) {        
        Books.get($routeParams.bookId).then(function(response){
            $scope.book = response.data;
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
            Books.get($routeParams.bookId).then(function(response){
                $scope.book = response.data;
            });
        }
                
        $scope.genres = Genres.query(); 
        
        $scope.save = function (book, saveForm){                                   
            $scope.invalidName = '';
            $scope.invalidAuthor = '';
            $scope.invalidDescription = '';
            $scope.invalidYear = '';
                        
            var valid = true;
            if (saveForm.$valid){
                if (book.name.length > 150) {
                    valid = false;
                    $scope.invalidName = 'Максимально 150 символов';
                }
                if (book.author.length > 100) {
                    valid = false;
                    $scope.invalidAuthor = 'Максимально 100 символов';
                }
                if (book.description.length > 2000) {
                    valid = false;
                    $scope.invalidDescription = 'Максимально 2000 символов';
                }
                if (book.publishing_year.length > 4 || !book.publishing_year.match('^[0-9]+$')) {
                    valid = false;
                    $scope.invalidYear = 'Введите число от 0 до 9999';
                }
                //save
                if (valid) {
                    Books.save(book);
                    $location.path('/books');                
                }
            }            
        };
    }            
]);
