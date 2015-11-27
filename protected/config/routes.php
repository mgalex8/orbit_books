<?php

return array(	
        //modules
        'api/version'                                   => 'api/index/version',
    
        //Rest API
        array('api/books/list', 'pattern'=>'api/books', 'verb'=>'GET'),
        array('api/books/view', 'pattern'=>'api/books/<id:\d+>', 'verb'=>'GET'),
        array('api/books/edit', 'pattern'=>'api/books/<id:\d+>', 'verb'=>'PUT'),
        array('api/books/delete', 'pattern'=>'api/books/<id:\d+>', 'verb'=>'DELETE'),
        array('api/books/add', 'pattern'=>'api/books', 'verb'=>'POST'),        
    
        array('api/genres/list', 'pattern'=>'api/genres', 'verb'=>'GET'),
        
        //application
        '<controller:\w+>/<action:\w+>/<id:\S+>'        => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>'                 => '<controller>/<action>',
        '<controller:\w+>'                              => '<controller>/index',
);
