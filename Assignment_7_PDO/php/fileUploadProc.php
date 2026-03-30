<?php
require_once '../classes/Db_conn.php';
require_once '../classes/Pdo_methods.php';

$output = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['fileName'])) {
        $output = "Please enter a file name.";
    } else {
        if (isset($_FILES["fileSelectField"])) {
            $file = $_FILES["fileSelectField"];

            if ($file["size"] > 100000 || $file["error"] == UPLOAD_ERR_INI_SIZE) {
                $output = "File is too large.";
            } else {
                $fileType = mime_content_type($file["tmp_name"]);

                if ($fileType != "application/pdf") {
                    $output = "Only PDF files are allowed.";
                } else {
                    $fileExt = "pdf";
                    $filePath = "files/{$_POST['fileName']}.{$fileExt}";

                    if (move_uploaded_file($file["tmp_name"], "../{$filePath}")) {

                        $sql = "INSERT INTO FILES (fileName, filePath) 
                                VALUES (:fileName, :filePath)";

                        // Each binding is [placeholder, value, type]
                        $bindings = [
                            [":fileName", $_POST['fileName'], "str"],
                            [":filePath", $filePath,         "str"]
                        ];

                        $db = new PdoMethods();
                        $result = $db->otherBinded($sql, $bindings);

                        if ($result == "noerror") {
                            $output = "File '{$_POST['fileName']}' was successfully uploaded and saved.";
                        } else {
                            $output = "File uploaded but could not be saved to the database.";
                        }

                    } else {
                        $output = "There was a problem uploading your file - please try again.";
                    }
                }
            }
        } else {
            $output = "No file was uploaded. Make sure you choose a file to upload.";
        }
    }
}
?>