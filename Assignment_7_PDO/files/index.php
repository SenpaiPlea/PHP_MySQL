



<?php
require_once '../php/fileUploadProc.php';


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File and Directory Assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .page-wrapper {
            padding: 16px;
        }
        .resizable-textarea {
            resize: both;
        }
    </style>
</head>

<body class="container">
 <h1>File Upload</h1>
 <h4><a href="listFiles.php">Show file list</a></h4>

     <div class="mt-3">
        <?php echo $output; ?>
    </div>

    <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="fileName">File name</label>
        <input type="text" id="fileName" name="fileName" class="form-control" placeholder="Enter your file name">
    </div>
    <div class="mb-3">
        <input type="file" name="fileSelectField" id="fileSelectField" class="form-control-file">
    </div> 
        <input type="submit" value="Upload file" class="btn btn-primary">
    </form>



</body>
</html>


<!--
Explain why were are using the DB_conn class
Explain why we are using the Pdo_methods class
Why are we storing the PDF files on the web server and not in the database
The PdoMethods class extends DatabaseConn. Explain the benefits of this inheritance structure and how it promotes code reusability and separation of concerns.
In the fileUploadProc.php, the code uses prepared statements with bindings. 
Explain how this approach prevents SQL injection attacks and why it's considered a security best practice. -->