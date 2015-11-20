<?php

class IndexController extends Controller
{	
        public $layout = 'layout_main';
                
	public function actionIndex()
	{            
            $this->render('index', array());
	}    
        
        
        public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
                    echo json_encode(array(
                            'error' => $error['message'],
                    ));
	    	else
                    $this->render('error', $error);
	    }
	}
        
}
