<?php

return array(	
        //modules
        'api/version'                                   => 'api/index/version',
        '<module:\w+>/<controller:\w+>/list'            => '<module>/<controller>/list',
        '<module:\w+>/<controller:\w+>/add'             => '<module>/<controller>/add',
        '<module:\w+>/<controller:\w+>/edit/<id:\S+>'   => '<module>/<controller>/edit',
        '<module:\w+>/<controller:\w+>/view/<id:\S+>'   => '<module>/<controller>/view',
        '<module:\w+>/<controller:\w+>/delete/<id:\S+>' => '<module>/<controller>/delete',        
        
        //application
        '<controller:\w+>/<action:\w+>/<id:\S+>'        => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>'                 => '<controller>/<action>',
        '<controller:\w+>'                              => '<controller>/index',
);
