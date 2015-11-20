'use strict';

/* Services */

var booksServices = angular.module('booksServices', ['ngResource']);

booksServices.factory('Book', ['$resource',
    function($resource){
        return $resource('api/books/list', {}, {
            query: {method:'GET', params:{bookId:'books'}, isArray:true},            
        });
    }
]);

booksServices.factory('Genres', ['$resource',
    function($resource){
        return $resource('api/genres/list', {}, {
            query: {method:'GET', params:{genreId:'genres'}, isArray:true}
        });
    }
]);

