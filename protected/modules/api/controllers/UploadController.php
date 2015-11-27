<?php

class UploadController extends Controller
{	        
        
        public function actionIndex() 
        {           
                $upload = FileUpload::upload('file', 'images', 512000);
                if (empty($upload['error'])) 
                {
                    $image = new Image;                        
                    $image->url = $upload['url'];
                    $image->size = $upload['size'];                        
                    $image->original_name = $upload['name'];
                    $image->type = $data['type'];

                    if ($image->save()) {
                        $json['success'] = 1;
                        $json['id'] = $image->id;
                        $json['url'] = $upload['url'];
                        $json['size'] = $upload['size'];
                        $json['original_name'] = $upload['name'];
                        $json['type'] = $upload['type'];                        
                    }
                }
                else {
                    $json['success'] = 0;
                    $json['error'] = $upload['error'];
                }
                
                echo CJSON::encode($json);
        }       
}
