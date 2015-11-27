'use strict';

/* Controllers */

var booksControllers = angular.module('booksControllers', []);

booksControllers.controller('BookListCtrl', ['$scope', 'Book',
    function($scope, Book) {
        $scope.books = Book.query();
        $scope.orderProp = 'id';
    }
]);

booksControllers.controller('BookViewCtrl', ['$scope', '$routeParams', 'Book',
    function($scope, $routeParams, Book) {
        $scope.book = Book.get({bookId: $routeParams.bookId}, function(book) {});    
    }
]);


booksControllers.controller('BookAddCtrl', ['$scope', '$http', 'Book', 'Genres',
    function ($scope, $http, Book, Genres) {
        $scope.book = {};
        $scope.genres = Genres.query();        

        $scope.save = function (book, saveForm){
            if (saveForm.$valid){

                $http.post("/api/books/add", book).success(function (resp) {
                    if (resp.error.length == 0) {
                        $location.path('/books'); 
                    }
                });
            }
        };
    }            
]);
