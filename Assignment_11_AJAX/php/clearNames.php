<?php
require "../classes/Pdo_methods.php";
header("Content-Type: application/json");

function clearNames() {
    $pdo = new PdoMethods();
    $results = $pdo->otherBinded(
        $sql = "DELETE FROM NAMES",
        $bindings = []
        );

        if ($results == 'error') {
            //Failure
            $result = array(
                "masterstatus" => "error",
                "msg" => "Something went wrong clearing names"
            );
            echo json_encode($result);
        } else {
            //Success
            $result = array(
                "masterstatus" => "success",
                "msg" => "Names cleared successfully"
            );
            echo json_encode($result);
        }

}
clearNames();
?>