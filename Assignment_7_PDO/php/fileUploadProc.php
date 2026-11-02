<?php
require_once '../classes/Db_conn.php';
require_once '../classes/Pdo_methods.php';

$output = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES["fileSelectField"] ?? null;

    if (empty($_POST['fileName'])) {
        $output = "Please enter a file name.";

    } elseif ($file === null || $file["error"] === UPLOAD_ERR_NO_FILE) {
        $output = "No file was selected. Please choose a PDF to upload.";

    } elseif ($file["error"] === UPLOAD_ERR_INI_SIZE
           || $file["error"] === UPLOAD_ERR_FORM_SIZE
           || $file["size"] > 100000) {
        $output = "File is too large. Please upload a file smaller than 100000 bytes.";

    } elseif ($file["error"] !== UPLOAD_ERR_OK) {
        $output = "There was a problem uploading your file - please try again.";

    } elseif (mime_content_type($file["tmp_name"]) !== "application/pdf") {
        $output = "Invalid file type. Please upload a .PDF file.";

    } else {
        // Everything checks out
        $fileName = $_POST['fileName'];
        $filePath = "files/{$fileName}.pdf";

        if (move_uploaded_file($file["tmp_name"], "../{$filePath}")) {
            $sql = "INSERT INTO files (fileName, filePath) VALUES (:fileName, :filePath)";
            $bindings = [
                [":fileName", $fileName, "str"],
                [":filePath", $filePath, "str"]
            ];

            $db = new PdoMethods();
            $result = $db->otherBinded($sql, $bindings);

            $output = ($result == "noerror")
                ? "File '{$fileName}' was successfully uploaded and saved."
                : "File uploaded but could not be saved to the database.";
        } else {
            $output = "There was a problem uploading your file - please try again.";
        }
    }
}
?>