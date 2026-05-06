<?php
require_once '../classes/Pdo_methods.php';

$pdo = new PdoMethods();
$message = "";
$contacts = [];
$ageRanges = [
    '1' => '0-17',
    '2' => '18-30',
    '3' => '30-50',
    '4' => '50+'
];

// Handle contact deletion
if (isset($_POST['delete']) && !empty($_POST['chkbx'])) {
    $deletedCount = 0;
    foreach ($_POST['chkbx'] as $id) {
        $sql = "DELETE FROM CONTACTS WHERE id = :id";
        $bindings = [[":id", $id, 'int']];
        $result = $pdo->otherBinded($sql, $bindings);
        if ($result === 'noerror') {
            $deletedCount++;
        }
    }

    if ($deletedCount > 0) {
        $message = "<div class='alert alert-success'>Deleted {$deletedCount} contact(s).</div>";
    } else {
        $message = "<div class='alert alert-danger'>No contacts were deleted.</div>";
    }
}

// Load contact records for display
$sql = "SELECT id, fname, lname, address, city, state, zip, phone, email, dob, contacts, age FROM CONTACTS";
$contacts = $pdo->selectNotBinded($sql);
if ($contacts === 'error') {
    $contacts = [];
    $message = "<div class='alert alert-danger'>Unable to load admin records.</div>";
}
?>