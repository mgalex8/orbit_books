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
    
    service.lastUploadImage;

    service.getAll = function() {        
        return books;
    }  

    service.get = function(id) {
        return $http.get('api/books/'+id);        
    }
    
    service.save = function(book) {        
        if (service.lastUploadImage !== undefined) {
            book.image_id = service.lastUploadImage.id;
        }
        
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
    
    service.upload = function(element) {        
        if (element.type == 'image/jpeg' || element.type == 'image/gif' || element.type == 'image/png') 
        {                
            var image_data = {
                name: element.name,
                size: element.size,
                type: element.type,                
            };            
            
            var reader = new FileReader();
            reader.onloadend = function(e){               
                image_data.data = e.target.result;
                console.log(image_data, 'image_data');
                var fd = new FormData();
                fd.append('data', image_data.data);
                fd.append('name', image_data.name);
                fd.append('size', image_data.size);
                fd.append('type', image_data.type);
                console.log(fd);
                
                return $http({url: 'api/images', method: "POST", data: fd})
                    .then(function (response) {                        
                        service.lastUploadImage = response.data;
                        console.log(service.lastUploadImage, 'service.lastUploadImage');
                    });
            };
            reader.readAsBinaryString(element);                      
        }
        else {
            return false;
        }
    }
    
    service.getLastUploadImage = function() {
        return service.lastUploadImage;
    }
    
    service.emptyUploadImage = function() {
        service.lastUploadImage = undefined;
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

booksServices.factory('httpUploadFactory', function ($http) {
    return function (file, data, callback) {
        $http({
            url: file,
            method: "POST",
            data: data,
            headers: {'Content-Type': undefined}
        }).success(function (response) {
            callback(response);
        });
    };
});

