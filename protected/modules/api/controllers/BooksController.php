<?php

class BooksController extends Controller
{	        
        
        public function actionIndex() 
        {       
               echo 'test'; 
        }
        
        public function actionList() {
                $criteria = new CDbCriteria;            
                $criteria->select = 'id, name, author, publishing_year, description, genre_id, image_id';                        
                $criteria->order = 'id ASC';

                $itemPerPage = $_POST['itemPerPage'];
                if (!empty($itemPerPage)) {            
                    $count = Book::model()->count($criteria);            
                    $pages = new CPagination($count);            
                    $pages->pageSize = $itemPerPage;
                    $pages->applyLimit($criteria);
                }
                $books = Book::model()->findAll($criteria);

                $data = array();                    
                foreach ($books as $book) {
                    $bookImageUrl = $book->image->url !== null ? $book->image->url : '/images/no-image.jpg';

                    $item = array(
                        'id' => $book->id,
                        'name' => $book->name,
                        'author' => $book->author,
                        'publishing_year' => $book->publishing_year,
                        'description' => $book->description,
                        'genre' => $book->genre->name,
                        'image' => $bookImageUrl,
                    );
                    $data[] = $item;
                }
                echo json_encode($data);
        }
        
        
        public function actionView($id) 
        {   
                if ($book = Book::model()->findByPk($id)) 
                {           
                    $bookImageUrl = $book->image->url !== null ? $book->image->url : '/images/no-image.jpg';
                    $json = array(                        
                        'id' => $book->id,
                        'name' => $book->name,
                        'author' => $book->author,
                        'publishing_year' => $book->publishing_year,
                        'description' => $book->description,
                        'genre_id' => $book->genre_id,
                        'genre' => $book->genre->name,
                        'image_id' => $book->image_id,
                        'image' => $bookImageUrl,                   
                    );
                }
                else {
                    $json = array(   
                        'success' => 0,
                        'error' => 'Not found id: '.$id,
                    );                
                }            
                echo json_encode($json);
        }
        
        
        public function actionAdd() 
        {   
                $book = new Book;
                $json = $this->addedit($book);
                echo json_encode($json);
        }
        
        
        public function actionEdit($id) 
        {                       
                $book = Book::model()->findByPk($id);
                $json = $this->addedit($book);
                echo json_encode($json);
        }
        
        
        public function actionDelete($id) 
        {   
                if ($book = Book::model()->findByPk($id)) {
                    //Book::model()->deleteByPk($id);
                    $book->delete();
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
        
        
        protected function addedit($book) 
        {       
                $data = CJSON::decode(file_get_contents('php://input'));
                
                if ($book) {
                    $upload = FileUpload::upload('image', 'images', 512000);
                    if (empty($upload['error'])) 
                    {
                        $image = new Image;                        
                        $image->url = $upload['url'];
                        $image->size = $upload['size'];
                        $image->type = $upload['type'];
                        $image->original_name = $upload['name'];
                        if ($image->save()) {
                            $bookImageId = $image->id;                  
                        }
                    }                    
                    
                    //save attributes
                    $book->attributes = $data;
                    if (!empty($bookImageId)) {
                        $book->image_id = $bookImageId;
                    }
                    
                    if ($book->save()) {
                        $json['success'] = 1;  
                        $json['book'] = $data;
                        $json['book']['id'] = $book->id;
                    }
                    else {
                        $json['success'] = 0;  
                        $json['error'] = 'Do not save';  
                    }
                }    
                else {
                    $json['success'] = 0;
                    $json['error'] = 'Not found id: '.$id;
                }
                return $json;
        }
        
}
