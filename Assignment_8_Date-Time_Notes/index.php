<?php

/*
Why are we using timestamps instead of the date.

Is there any advantage to using the Date_time class over just having a PHP function file.  What are they?

When a user requests to view notes within a specific date range, what logical steps must the application take to retrieve and present only the relevant notes, show that in your code and explan it?

Explain the importance of converting dates and times into a standardized format (like a timestamp) before storing them in a database. What problems might arise if you don't?

Imagine the application becomes very popular and has millions of notes. What performance considerations might arise when displaying notes, and how could you address them?
*/

require_once 'classes/Date_time.php';
$dt = new Date_time();
$notes = $dt->checkSubmit();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .page-wrapper {
            padding: 16px;
        }

        .resizable-textarea {
            resize: both;
        }
        
    textarea {
      width: 200px;
      height: 400px;
    }
  
    </style>
</head>

<body class="container">
<div class="page-wrapper">
 <h1>Add Note</h1>
 <h4><a href="display_notes.php">Display Notes</a></h4>

     <div class="mt-3">
        <?php echo $notes; ?>
    </div>

    <form method="POST">
    <div class="mb-3">
        <label for="dateTime">Date and time</label>
        <input type="datetime-local" id="dateTime" name="dateTime" class="form-control">
    </div>
    <div class="mb-3">
        <label for="note">Note</label>
        <textarea id="note" name="note" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <input type="submit" value="Add Note" name="addNote" class="btn btn-primary">
    </form>
</div>


</body>
</html>