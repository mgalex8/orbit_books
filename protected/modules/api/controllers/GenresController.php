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
                echo json_encode($items);
        }
        
        
        public function actionView($id) 
        {   
                if ($genre = Genre::model()->findByPk($id)) 
                {                
                    $json = array(                        
                        'id' => $genre->id,
                        'name' => $genre->name,                        
                    );
                }
                else {
                    $json = array(                        
                        'error' => 'Not found id: '.$id,
                    );                
                }            
                echo json_encode($json);
        }
        
        
        public function actionAdd() 
        {   
                $genre = new Genre;
                $json = $this->addedit($genre);
                echo json_encode($json);
        }
        
        
        public function actionEdit($id) 
        {   
                if ($genre = Genre::model()->findByPk($id)) 
                {                
                    $json = $this->addedit($genre);
                }
                else {
                    $json = array(                        
                        'error' => 'Not found id: '.$id,
                    );                
                }            
                echo json_encode($json);
        }
        
        
        public function actionDelete($id) 
        {   
                if ($book = Genre::model()->findByPk($id)) {                    
                    $genre->delete();
                    $json = array(
                        'success' => 1,
                    );
                }
                else {
                    $json = array(
                        'success' => 0,
                        'error' => 'Not found id: '.$id,
                    );
                }
                return json_encode($json);
        }   
        
        
        protected function addedit($genre)
        {
                $genreName = $_POST['name']; 
                
                $genre->name = $genreName;                        
                if ($genre->save()) 
                {
                    $json = array(
                        'success' => 1,
                    );
                }
                else {
                    $json = array(
                        'success' => 0,
                        'error' => 'Do not save genre'
                    );
                }
                return $json;
        }
        
}
