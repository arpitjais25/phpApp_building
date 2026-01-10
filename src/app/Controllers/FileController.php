<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use Ramsey\Uuid\Type\Integer;

class FileController
{
    
    public function upload_file(): string
    {
        return View::make('File_Upload/File_upload');
    }
    public function upload_sucsessfull(): void
    {
        if (isset($_FILES['upload_file']) && ($_FILES['upload_file']['error'] === 0)) {


            echo "<h1>File Upload Sucsessfully Completed...</h1>";
            echo "<pre>";
            print_r($_FILES);
            echo "<hr>";
            print_r($_POST);
            move_uploaded_file($_FILES['upload_file']['tmp_name'], FILE_PATH . "/upload_file_" . $_FILES['upload_file']['name']);
            $display =  "Storage/upload_file_" .$_FILES['upload_file']['name'];
            // sleep(30);
            echo <<<FORM
                    <form  action='/home/upload/display' method='post'>
                    <input type='text' name='file_path' value='$display'>
                    <input type='submit' value='submit' >
                    </form>

            FORM;
            
            // echo '<script>
            //         window.location.href="/home/upload/sucsess";
            // </script>';
            
        } else {
            echo '<script>
                    alert("File Uploading Faild Try Again");
                    window.location.href="/home/upload";
                </script>';
        }
    }
    // @display
    public function display_file()
    {
        return View::make('File_Upload/file-display', ['imagePath'=>$_POST]);

    }
}
?>
