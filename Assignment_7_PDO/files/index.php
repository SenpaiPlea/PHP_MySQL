<!-- Explain why were are using the DB_conn class
Explain why we are using the Pdo_methods class
Why are we storing the PDF files on the web server and not in the database
The PdoMethods class extends DatabaseConn. Explain the benefits of this inheritance structure and how it promotes code reusability and separation of concerns.
In the fileUploadProc.php, the code uses prepared statements with bindings. Explain how this approach prevents SQL injection attacks and why it's considered a security best practice. -->

<!-- The user will enter a file name in the text box provided on the form.  
They will also upload a PDF file with the file element. The application will check to make sure the file is under 100000 bytes and it is a PDF mime type. 
If either of those conditions is wrong, then an appropriate error message is displayed. -->

<!-- This is an example of the link you will need for each document that is linked from the database.
<li><a target='_blank' href='files/newsletterorform1.pdf'>test 1</a></li>
 You must use the Pdo_methods and Db_conn classes I have provided in the book and examples. 
 Remember you will need to set the database connection information in the Db_conn class to whatever your database connection information is. -->

 <!-- The file path where the file you put on the server is located and the file name will be stored in a single database table that you will create.

The table will have three fields:

    The primary key for each row
    The file name the user entered
    The file path to the file (the file you put on the server) -->




<!-- if file > 100000bytes 
    $output = "File is too large. Please upload a file smaller than 100000 bytes.";
    return $output;

if mime type is not PDF 
    $output = "Invalid file type. Please upload a .PDF file.";
    return $output;

echo $output; (in the body where the acknowledgement appears).
if successful
    $output = "File uploaded successfully. The file name and file path have been stored in the database.";
    return $output;

if successfully uploaded, the file name and file path will be stored in the database. The file path will be used to create a link to the PDF file on the web server. -->

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