<?php

class FileUpload {
    
    public function upload($fieldName, $dir = '', $maxFileSize = 5242880, $md5_name = true) 
    {    
        if (is_numeric($maxFileSize) && $_FILES[$fieldName]['size'] > intval($maxFileSize)) {
            return array(
                'success' => 0,
                'error' => 'Превышен максимальный размер файла',
            );
        }
        
        $baseUrl = '/upload/';
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . $baseUrl;
        if (!empty($dir) && file_exists($uploadDir.$dir)) {
            $baseUrl .= $dir.'/';
            $uploadDir .= $dir.'/';            
        }
        
        $phpFileUploadErrors = array(
            0 => 'There is no error, the file uploaded with success',
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        );
        
        if ($_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) 
        {
            $name = $_FILES[$fieldName]['name'];
            $size = $_FILES[$fieldName]['size'];
            $type = $_FILES[$fieldName]['type'];
        
            if ($md5_name) {
                $pInfo = pathinfo($name);
                $fileName = md5(basename($name) . time()) . '.' . $pInfo['extension'];
            }
            else {
                $fileName = $name;                
            }
            $url = $baseUrl . $fileName;
            $uploadFile = $uploadDir . $fileName;
        
            if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $uploadFile)) {
                return array(
                    'success' => 1,
                    'url' => $url,
                    'name' => $name,
                    'type' => $type,
                    'size' => $size,
                );
            } else {
                $error = $_FILES[$fieldName]['error'];
                return array(
                    'success' => 0,
                    'error' => 'Не удалось загрузить файл',
                );
            }
        }
        else {
            return array(
                'success' => 0,
                'error' => $phpFileUploadErrors[$error],
            );
        }
    }
    
}

