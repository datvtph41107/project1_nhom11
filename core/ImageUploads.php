<?php 
namespace app\core;

class ImageUploads
{
    public string $fileName = ''; 

    public function __construct(string $file)
    {
        $this->fileName = $file;
    }

    public function moveUpload()
    {
        // var_dump($this->fileName);
        // exit;
        $destinationPath = 'assets/uploads/';
        $targetFile = $destinationPath . basename($_FILES[$this->fileName]['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES[$this->fileName]["tmp_name"], $targetFile);
        return $targetFile;
    }
}

?>