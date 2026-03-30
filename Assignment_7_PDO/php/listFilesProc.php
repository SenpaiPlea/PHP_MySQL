<?php
require_once '../classes/Db_conn.php';
require_once '../classes/Pdo_methods.php';

$output = "";

$sql = "SELECT fileName, filePath FROM FILES ORDER BY id DESC";

$db   = new PdoMethods();
$rows = $db->selectNotBinded($sql);

if ($rows == "error" || empty($rows)) {
    $output = "<p>No files have been uploaded yet.</p>";
} else {
    $output = "<ul>";
    foreach ($rows as $row) {
        $name = htmlspecialchars($row['fileName']);
        $path = htmlspecialchars($row['filePath']);
        $output .= "<li><a href='../{$path}' target='_blank'>{$name}</a></li>";
    }
    $output .= "</ul>";
}
?>