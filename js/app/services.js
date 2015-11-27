'use strict';

/* Services */

var booksServices = angular.module('booksServices', ['ngResource']);


booksServices.factory('Books', ['$http', '$rootScope', function($http, $rootScope) {

    // books array
    
    var books = [];

    function getBooks() {
        $http({method: 'GET', url: 'api/books'})
            .success(function(data, status, headers, config) {                                
                console.log(data);
                books = data;           
                $rootScope.$broadcast('books:updated');
            })
            .error(function(data, status, headers, config) {                
                console.log(data);
            });
    }
    getBooks();

    // factory methods
    
    var service = {};

    service.getAll = function() {        
        return books;
    }  

    service.get = function(id) {
        return $http.get('api/books/'+id);        
    }
    
    service.save = function(book) {
        if (undefined !== book.id && parseInt(book.id) > 0) {
            service.update(book);
        }
        else {
            service.add(book);
        }
    }

    service.add = function(book) {
        $http({method: 'POST', url: 'api/books', data: book})
            .success(function(data, status, headers, config) {                
                console.log(data);                
                if (data.success == 1) {
                    books.push(data.book);
                    $rootScope.$broadcast('book:added', data);
                }
            })
            .error(function(data, status, headers, config) {                
                console.log(data);
                $rootScope.$broadcast('book:error', data);
            });
    }

    service.update = function(book) {
        $http({method: 'PUT', url: 'api/books/' + book.id, data: book})
            .success(function(data, status, headers, config) {                
                console.log(data);
                if (data.success == 1) {
                    angular.forEach(books, function(value, i) {
                            if (parseInt(value.id) === parseInt(book.id)) {
                                books[i] = book;
                                return false;
                            }
                        });
                }
                $rootScope.$broadcast('book:updated', data);
            })
            .error(function(data, status, headers, config) {                
                console.log(data);
                $rootScope.$broadcast('book:error', data);
            });
    }

    service.delete = function(book) {
        var title = 'Удалить книгу "' + book.name + '"?';
        if (confirm(title)) {
            $http({method: 'DELETE', url: 'api/books/' + book.id})
                .success(function(data, status, headers, config) {
                    console.log(data);
                    if (data.success == 1) {
                        angular.forEach(books, function(value, i) {
                            if (parseInt(value.id) === parseInt(book.id)) {
                                books.splice(i, 1);
                                return false;
                            }
                        });
                    }
                    $rootScope.$broadcast('book:deleted', data);
                })
                .error(function(data, status, headers, config) {
                    console.log(data);
                    $rootScope.$broadcast('book:error', data);
                });
        }
    }

    return service;
}]);


booksServices.factory('Genres', ['$resource',
    function($resource){
        return $resource('api/genres', {}, {
            query: {method:'GET', params:{genreId:'genres'}, isArray:true}
        });
    }
]);

