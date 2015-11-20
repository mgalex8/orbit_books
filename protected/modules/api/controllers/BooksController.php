<?php

class BooksController extends Controller
{	        
        
        public function actionIndex() {
            echo 'test';
        }
        
        public function actionList() 
        {    
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

                $items = array();
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
                    $items[] = $item;
                }
                echo json_encode($items);
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
                        'genre' => $book->genre->name,
                        'image' => $bookImageUrl,                   
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
                $book = new Book;
                $json = $this->addedit($book);
                echo json_encode($json);
        }
        
        
        public function actionEdit($id) 
        {   
                if ($book = Book::model()->findByPk($id)) 
                {                
                    $json = $this->addedit($book);
                }
                else {
                    $json = array(
                        'success' => 0,
                        'error' => 'Not found id: '.$id,
                    );                
                }            
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
                $bookName = $_POST['name'];
                $bookAuthor = $_POST['author'];
                $bookPublichingYear = $_POST['publiching_year'];
                $bookDescription = $_POST['description'];
                $bookGenreId = $_POST['genre_id'];            

                // FileUpload - user component 
                // base path - *.components
                $upload = FileUpload::upload('image', 'images', 512000);
                if (empty($upload['error'])) 
                {
                    // Save Image
                    if (!empty($book->id)) {
                        $image = Image::model()->findByPk($book->image_id);
                    }
                    else {
                        $image = new Image;
                    }
                    $image->url = $upload['url'];
                    $image->size = $upload['size'];
                    $image->type = $upload['type'];
                    $image->original_name = $upload['name'];
                    $image->save();       

                    $bookImageId = $image->id;

                    // Save Book
                    if ($book->genre->findByPk($bookGenreId)) 
                    {
                        $book->name = $bookName;
                        $book->author = $bookAuthor;
                        $book->publiching_year = $bookPublichingYear;
                        $book->description = $bookDescription;                
                        $book->genre_id = $bookGenreId;
                        $book->image_id = $bookImageId;
                    }
                    $book->save();

                    $json = array(
                        'success' => 1,
                    );
                }
                else {
                    $json = array(
                        'success' => 1,
                        'error' => $upload['error'],
                    );
                }
                return $json;
        }
        
}
