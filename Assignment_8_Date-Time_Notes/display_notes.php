<?php
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
    </style>
</head>

<body class="container">
<h1>Display Notes</h1>
 <h4><a href="index.php">Add Note</a></h4>

 

    <form method="POST">
    <div class="mb-3">
        <label for="begDate">Beginning Date</label>
        <input type="date" class="form-control" id="begDate" name="begDate">
    </div>
    <div class="mb-3">
        <label for="endDate">Ending Date</label>
        <input type="date" class="form-control" id="endDate" name="endDate">
    </div>
    <div class="mb-3">
        <input type="submit" value="Get Notes" name="getNotes" class="btn btn-primary">
    </form>
     <div class="mt-3">
        <?php echo $notes; ?>
    </div>

</body>
</html>