<?php
require_once '../classes/Pdo_methods.php';

$pdo = new PdoMethods();
$message = "";
$admins = [];

// Handle admin deletion
if (isset($_POST['delete']) && !empty($_POST['chkbx'])) {
    $deletedCount = 0;
    foreach ($_POST['chkbx'] as $id) {
        $sql = "DELETE FROM ADMINS WHERE id = :id";
        $bindings = [[":id", $id, 'int']];
        $result = $pdo->otherBinded($sql, $bindings);
        if ($result === 'noerror') {
            $deletedCount++;
        }
    }

    if ($deletedCount > 0) {
        $message = "<div class='alert alert-success'>Deleted {$deletedCount} admin(s).</div>";
    } else {
        $message = "<div class='alert alert-danger'>No admins were deleted.</div>";
    }
}

// Load admin records for display
$sql = "SELECT id, fname, lname, email, password, status FROM ADMINS";
$admins = $pdo->selectNotBinded($sql);
if ($admins === 'error') {
    $admins = [];
    $message = "<div class='alert alert-danger'>Unable to load admin records.</div>";
}
?>