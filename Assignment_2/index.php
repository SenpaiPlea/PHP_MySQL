<!-- You will create a webpage that will have the following PHP written at the top above the HTML Doctype.

    Create a foreach loop that will loop through an array of numbers from 1 to 50 and display the even numbers only. 
      Each even number will be separated by a space, a hyphen, and another space.  The last number cannot have a space, hyphen, or space after it so you have to trim it off.  
      The resulting string of text will be stored in a variable named "$evenNumbers".  
        NOTE: The array must go through all the numbers 1 through 50 and only display the even ones.
    You will write a heredoc that will create a textbox with the label "Email address" and a textarea with the label "Example textarea".  
      They must be written with Bootstrap styling and have the appropriate accessibility.  The entire form code must be in the heredoc.  
      The resulting string will be stored in a variable named "$form".
    You will create a function named "createTable" that will take two numbers as parameters. The first number is "rows" and the second is "columns".  
      The function will create a table with a pre-set number of rows and columns  (for this example it will be 8 rows and 6 columns".  
      The table borders will be styled via Bootstrap.  The resulting string will be stored in a variable named "$table" and that will be returned to what is calling the function.

As stated above, you will write all the PHP above the doctype all that is in the body of the HTML is the following (it must be like this). -->



<?php  
$numbers = range(1, 50);
$evenNumbers = "";
$table = "";
$form =  <<<FORM
<div class="mb-3">
  <label for="email" class="form-label">Email address</label>
  <input type="email" class="form-control" id="email">
</div>
<div class="mb-3">
  <label for="exampleTextarea" class="form-label">Example textarea</label>
  <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
</div>
FORM;


foreach($numbers as $even) {
  if ($even % 2 == 0) {
    $evenNumbers .= $even .  " - ";
  }
  else continue;
}
$evenNumbers = substr($evenNumbers, 0, -3);


function createTable($rows, $columns) {
  
$table = '<table class="table table-bordered">';

  for ($r = 1; $r <= $rows; $r++) {
    $table .= "<tr>";

    for ($c = 1; $c <= $columns; $c++) {
      $table .= "<td>Row $r, Col $c</td>";
    }
    $table .= "</tr>";
  }
  $table .= "</table>";

  return $table;
  };

?>

    <!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Assignment 2</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <style>
    .page-wrapper {
      padding: 16px;
    }
  </style>
</head>
<body class="container">

    <div class="page-wrapper">
      <?php
        echo $evenNumbers;
        echo $form;
        echo createTable(8, 6);
        ?> 
    </div>
</body>


<!-- 
    The assignment specifies that "all PHP written at the top above the HTML Doctype". Explain the implications of this placement on how the server processes the page. 
      What advantage does generating all PHP variables ($evenNumbers, $form, $table) before any HTML output provide in terms of execution flow?

    Beyond simply finding even numbers, describe a scenario where you would use a similar foreach loop with a conditional (if) statement to filter or process elements from 
      an array based on different criteria like finding all numbers divisiable by 7

    Discuss the primary benefits of using heredoc for embedding large blocks of HTML or other text within PHP strings, especially when that text contains quotes or 
      multiple lines. How does it improve code readability compared to concatenating strings with double quotes?

    The createTable function uses nested for loops to build the table. Describe the role of each loop: which one is responsible for iterating through the rows, and which for 
      the columns? How does the concatenation (.=) inside these loops incrementally build the complete HTML table string?

    The createTable() function returns a string that is later echoed, rather than echoing directly inside the function. Explain the benefits of this approach. 
      How does returning a value make the function more reusable and flexible compared to having the function echo directly? What are the implications for testing or reusing 
      this function in different contexts? 
      -->
