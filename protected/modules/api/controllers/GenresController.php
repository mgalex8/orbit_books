<?php

class GenresController extends Controller
{	        
        
        public function actionList() 
        {    
                $criteria = new CDbCriteria;            
                $criteria->select = 'id, name';
                $criteria->order = 'id ASC';                                 
                
                $genres = Genre::model()->findAll($criteria);
                
                $items = array();
                foreach ($genres as $genre) {
                    $item = array(
                        'id' => $genre->id,
                        'name' => $genre->name,                        
                    );
                    $items[] = $item;
                }
                echo CJSON::encode($items);
        }
        
}
