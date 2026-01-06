<?php

declare(strict_types=1);

namespace App\Controllers;

use Ramsey\Uuid\Type\Integer;

class FileController
{
    public function upload_file(): void
    {
        echo '<form action= "/home/upload" method="post" enctype="multipart/form-data">
                    <label>Upload File</lable>
                    <input type="file" name="upload_file"/>
                    <input type="email" name="email" />
                    <input type="submit"/>
                </form>';
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
            $display =   "/../Storage/upload_file_" . $_FILES['upload_file']['name'];
            // sleep(30);
            echo <<<FORM
                    <form id='file_submit' action='/home/upload/display' method='post'>
                    <input type='text' name='file_path' value='$display'>
                    <input type='submit' value='submit' >
                    </form>
                    
                FORM;
            
            // echo '<script>
            //         window.location.href="/home/upload/display";
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
        print_r($_POST);
        $file_path = $_POST["file_path"];
        echo '<div style="border: 2px solid black; height: 400px; width: 400px;">
                 <img src="public/storage/upload_file_8b91147ed78b801218b4fa0c2ac9d9e7.jpg">
                </div>';

    }
}
?>
