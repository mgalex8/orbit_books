<?php

class IndexController extends Controller
{	        
	public function actionIndex()
	{   
            $moduleName = Yii::app()->controller->module->getName();
            $version = Yii::app()->controller->module->getVersion();
            
            echo json_encode(array(
                'name' => $moduleName,
                'version' => $version,
                'access' => 'free',
            ));
	}    
        
        public function actionVersion()
	{   
            echo json_encode(array(                
                'version' => Yii::app()->controller->module->getVersion(),
            ));
	}
        
}
