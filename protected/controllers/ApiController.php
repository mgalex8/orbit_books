<?php

class ApiController extends Controller
{    
       // public $layout = 'layout_main';
    
        public function actionVersion()
	{            
            echo json_encode(array(
                'name' => 'Books API',
                'version' => '0.6',
                'access' => 'free',
            ));
	}
        
}
