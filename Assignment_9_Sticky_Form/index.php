<!-- 
Why does StickyForm extend Validation instead of including validation logic directly? What are the benefits of this design?

Explain what "sticky form" means. How does it improve user experience compared to a non-sticky form?

Describe the validation process. When does validation occur, and what happens if validation fails?

Explain the purpose of the $formConfig array. What information does it store, and how is it used throughout the form lifecycle?

What is the purpose of masterStatus['error'] in the form configuration? How does it coordinate validation across multiple form fields? 
-->


<?php
require_once 'classes/StickyForm.php';
require_once 'classes/Pdo_methods.php';

$stickyForm = new StickyForm();
$PdoMethods = new PdoMethods();
$duplicateEmailError = '';
$formConfig = [
    'fName' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => '*First Name',
        'name' => 'fName',
        'id' => 'fName',
        'errorMsg' => 'You must enter a first name and it must be alpha characters only.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'lName' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => '*Last Name',
        'name' => 'lName',
        'id' => 'lName',
        'errorMsg' => 'You must enter a last name and it must be alpha characters only.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'password' => [
        'type' => 'text',
        'regex' => 'password',
        'label' => '*Password',
        'name' => 'password',
        'id' => 'password',
        'errorMsg' => 'Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'confPassword' => [
        'type' => 'text',
        'regex' => 'password',
        'label' => '*Confirm Password',
        'name' => 'confPassword',
        'id' => 'confPassword',
        'errorMsg' => 'Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => '*Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email address.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'masterStatus' => [
        'error' => false
    ]
];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);
    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {
        // check duplicate email
        $sql = "SELECT * FROM STICKYFORMS WHERE email = :email";
        $bindings = [[':email', $_POST['email'], 'str']];
        $result = $PdoMethods->selectBinded($sql, $bindings);
        if ($result) {
            $duplicateEmailError = 'There is already a record with that email.';
            $formConfig['masterStatus']['error'] = true;
        }

        // check passwords match
        if ($_POST["confPassword"] !== $_POST["password"]) {
            $formConfig["confPassword"]["error"] = "Passwords do not match.";
            $formConfig["masterStatus"]["error"] = true;
        }

        if (!$formConfig['masterStatus']['error']) {
            // safe to insert into database
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO STICKYFORMS (fName, lName, email, password) VALUES (:fname, :lname, :email, :password)";
            $bindings = [
                [':fname', $_POST['fName'], 'str'],
                [':lname', $_POST['lName'], 'str'],
                [':email', $_POST['email'], 'str'],
                [':password', $hashedPassword, 'str']
            ];
            $PdoMethods->otherBinded($sql, $bindings);
            
            foreach ($formConfig as $key => &$field) {
                if (isset($field['value'])) {
                    $field['value'] = '';
                }
            }
        }
    }
}

$bindings = [];
$sql = "SELECT fname, lname, email, password FROM STICKYFORMS";
$result = $PdoMethods->selectBinded($sql, $bindings);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 9 - Sticky Form</title>
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
        <h4>All fields are required.</h4>
        <?php echo $duplicateEmailError ?>
        <form method="post" action="">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $stickyForm->renderInput($formConfig['fName'], 'mb-3'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo $stickyForm->renderInput($formConfig['lName'], 'mb-3'); ?>
                </div>


            </div>
            <div class="row">
                <div class="col-md-4">
                    <?php echo $stickyForm->renderInput($formConfig['email'], 'mb-3'); ?>
                </div>

                <div class="col-md-4">

                    <?php echo $stickyForm->renderInput($formConfig['password'], 'mb-3'); ?>
                </div>
                <div class="col-md-4">
                    <?php echo $stickyForm->renderInput($formConfig['confPassword'], 'mb-3'); ?>
                </div>
            </div>
            <div>
                <button type="submit" name="register" class="btn btn-primary mt-3">Register</button>
            </div>

    </div>

    </form>

    <?php
    if (!empty($result)) {
        echo "<table class='table table-bordered mt-2'>";
        echo "<thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Password</th></tr></thead>";
        foreach ($result as $row) {
            $row['fname'] = htmlspecialchars($row['fname']);
            $row['lname'] = htmlspecialchars($row['lname']);
            $row['email'] = htmlspecialchars($row['email']);
            $row['password'] = htmlspecialchars($row['password']);
            echo "<tr><td>{$row['fname']}</td><td>{$row['lname']}</td><td>{$row['email']}</td><td>{$row['password']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='mt-2'>No records found.</p>";
    }
    ?>

    </div>
</body>

</html>