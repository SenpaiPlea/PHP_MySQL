<?php
require "../classes/Pdo_methods.php";
header("Content-Type: application/json");

function displayNames()
{
    $pdo = new PdoMethods();
    $html = "<ul style='list-style-type: none; margin: 0; padding: 0;'>";
    $results = $pdo->selectNotBinded("SELECT name FROM NAMES ORDER BY name ASC");


    if ($results == 'error') {
        //Failure
        $result = array(
            "masterstatus" => "error",
            "msg" => "Something went wrong"
        );
        echo json_encode($result);
    } elseif ((empty($results))) {
        $html .= "<li>No names to display</li></ul>";
        $result = array(
            "masterstatus" => "success",
            "names" => $html
        );
        echo json_encode($result);
    } else {
        //Success
        foreach ($results as $row) {
            $html .= "<li>" . $row["name"] . "</li>";
        }
        $html .= "</ul>";
        $result = array(
            "masterstatus" => "success",
            "names" => $html
        );
        echo json_encode($result);
    }
}
displayNames();
?>