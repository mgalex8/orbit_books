'use strict';

/* Services */

var booksServices = angular.module('booksServices', ['ngResource']);

booksServices.factory('Book', ['$resource',
    function($resource){
        return $resource('api/books', {}, {
            query: {method:'GET', params:{bookId:'books'}, isArray:true},            
        });
    }
]);

booksServices.factory('Genres', ['$resource',
    function($resource){
        return $resource('api/genres', {}, {
            query: {method:'GET', params:{genreId:'genres'}, isArray:true}
        });
    }
]);

