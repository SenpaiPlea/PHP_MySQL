<?php

function init() {
    // Get user name from session
    $fName = $_SESSION['fname'] ?? 'User';
    $lName = $_SESSION['lname'] ?? '';

    return <<<HTML
        <div class="container mt-5">
            <h1>Welcome Page</h1>
            <p>Welcome, {$fName} {$lName}!</p>
        </div>
HTML;
}

?>
