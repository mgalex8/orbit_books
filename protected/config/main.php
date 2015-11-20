<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Books',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
                'application.models.forms.*',
		'application.components.*',                                
	),        

	'defaultController'=>'index',
    
        'sourceLanguage'=>'en_US',
        'language'=>'ru_RU',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,                        
                        'loginUrl' => array('/'),
		),
		'db'=>require(dirname(__FILE__).'/db.php'),
            
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'index/error',
		),            
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
                        'caseSensitive'=>false,
			'rules'=>require(dirname(__FILE__).'/routes.php'),
		),                 
		'log'=>array(
			'class'=>'CLogRouter',
                        'enabled'=>YII_DEBUG,
			'routes'=>array(                            
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),                                				
                                /*                     
                                array(                                 
					'class'=>'CWebLogRoute',                                                                                
				),                             
                                */
			),
		),                  
	),	
);