<!-- AI PROMPT: Without giving me direct code, how can I go about this assignment that I am working on in PHP? 
 code comments show the general reccomendations from the AI response-->


<!-- The user will enter a directory name and some text content for a file. When the user clicks "Submit," a new directory will be created within the "directories" directory, named according to the user's input. Only alphabetic characters should be used for the directory name, with no spaces or special characters. We will assume the user follows these guidelines correctly.
A file named "readme.txt" will be placed inside the newly created directory. The content of this file will be whatever the user entered in the text area.
Upon successful creation of the directory and file, a link will appear at the top of the form that reads "Path where the file is located." When clicked, this link will display the contents of the "readme.txt" file in the browser.
You need to create two files for this project. The first file will contain your form and a small amount of PHP code above the doctype to call a class named "Directories", this file will be named "index.php"
The other file will be in a folder named "classes" and the file will be named "Directories.php".  The "Directories.php" file will be a class that will include a method to create the directory and the file. Additionally, the class will handle the following checks and responses:

    If the directory already exists, a message will be displayed stating, "A directory already exists with that name."
    If the directory or file cannot be created, an error message will be displayed.

All error messages will appear on the form page, as shown in the screenshots.

NOTE: Before starting this project, you must manually create the "directories" directory on the server.  This will be in your assignment5 folder. You create the directory but writing the following and then clicking enter:
mkdir directories

Then you will give it 777 permissions by writing the following and then clicking enter:
chmod 777  directories -->


<?php

// small PHP block that:

// Includes/requires your Directories.php class file
// Instantiates the Directories class
// Checks if the form was submitted (hint: check $_POST or the request method)
// If submitted, calls your class method with the user's input

// Complete the PHP block above the doctype — instantiate the class, add the $_SERVER['REQUEST_METHOD'] check, pull the values from $_POST, 
// call your method, and store the return value in a variable.
require_once 'classes/Directories.php';

$directory = new Directories();
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $folderName = $_POST['folderName'];
    $fileContent = $_POST['fileContent'];
    $result = $directory->createDirectoryAndFile($folderName, $fileContent);
    }

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

<body>

    <!-- In the HTML body, you need:

A spot to display the success link or error messages — conditionally shown based on what happened
A form with a text input for the directory name and a textarea for the file content 

Once the directory and file are created successfully, you need to display a link. 
Think about what the href should be — it needs to point to the readme.txt file inside the newly created directory. 
PHP can build that path string for you dynamically using the user's input.

file_exists() / is_dir() — checking existence
mkdir() — creating a directory
file_put_contents() — creating and writing a file in one step
require_once — including your class file
$_POST — accessing form data
$_SERVER['REQUEST_METHOD'] — detecting form submission
-->

    <div class="page-wrapper">
        <h1>File and Directory Creator</h1>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
            <?php
            // displays one of three things based on its value (null = nothing, success = link, error = message). 
            // Think about how to distinguish the success return value from your error strings.
            if ($result !== null) {
                if (strpos($result, 'Error') === false && strpos($result, 'already exists') === false) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo '<a href="' . $result . '" class="alert-link">Path where the file is located.</a>';
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">' . $result . '</div>';
                }
            }

            ?>
        <form class="row g-3" method="post" action="">
            <div class="col-md-12">
                <label for="folderName" class="form-label">Folder Name</label>
                <input type="text" class="form-control" id="folderName" name="folderName" required>
            </div>
            <div class="col-md-12">
                <label for="inputFContent" class="form-label">File Content</label>
                <textarea class="form-control resizable-textarea" id="inputFContent" name="fileContent" rows="5"
                    required></textarea>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

</body>

</html>



<!-- 
Explain the difference between creating a directory and creating a file in PHP. 
What PHP functions are used for each operation, and why is it important to check if a directory already exists before attempting to create it?

Describe the flow of data from an HTML form submission to PHP processing. 
How does PHP access form data, and what considerations should developers keep in mind when handling user input from forms?

 Why is it important to properly close file handles after writing to files? 
 What problems can occur if file handles are not closed, and how does this relate to system resource management?

Why did we use 777 permissions and what should we use and why.

Explain the benefits of organizing file and directory operations into a class structure. 
How does this approach improve code organization, reusability, and maintainability compared to writing all operations in procedural code? 
-->