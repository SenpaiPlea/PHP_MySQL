<?php
/**In main.js, the addName function uses fetch() to send data to addName.php. Explain the request/response flow: what data format is sent from JavaScript, 
 * how does PHP receive it, and what format must PHP return for JavaScript to process it?
 * 
 * Looking at displayNames.php, it returns different JSON structures for success cases (with names field) versus error cases (with msg field). 
 * Explain why maintaining a consistent response structure is important for the JavaScript code that processes these responses.
 * 
 * In displayNames.php, the code checks if $records === "error" and also checks count($records) > 0. 
 * Explain the difference between these two conditions and why both checks are necessary before processing the database results.
 * 
 * When a user clicks the "Add Name" button, main.js calls names.addName(), which then calls names.displayNames(). Explain why displayNames() is called after adding a name, 
 * and describe the sequence of AJAX requests that occur during this process.
 * 
 * After clearNames.php successfully clears the database, the JavaScript calls names.displayNames() to refresh the list. 
 * Explain why this refresh is necessary and what would happen if this call were omitted. How does this demonstrate the stateless nature of HTTP requests? */
require "../classes/Pdo_methods.php";
header("Content-Type: application/json");


function addName() {
    $pdo = new PdoMethods(); 
    // Get the raw data stream
    $rawInput = file_get_contents("php://input");
    $input = json_decode($rawInput, true);
    $name = $input["name"];
        
    /**
     * Confirm that the name is not empty and contains a space. 
     * If valid, split the name into first and last name, rearrange it to "lastname, firstname", and insert it into the database.
     */
    if ($name && strpos($name, " ") !== false) {
            $nameParts = explode(" ", $name);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1];
            $formattedName = $lastName . ", " . $firstName;

            $results = $pdo->otherBinded(
            $sql = "INSERT INTO NAMES (name) VALUES (:name)",
            $bindings =
                [[":name", $formattedName, "str"]]
        );

        if($results == 'noerror') {
            //Success
            $result = array(
            "masterstatus" => "success",
            "msg" => "Name added successfully"
        );
        echo json_encode($result); 
        } else if($results == 'error') {
            //Failure
            $result = array(
            "masterstatus" => "error",
            "msg" => "Something went wrong"
            );
        echo json_encode($result);
        }
    }
        else {
            //Invalid input
            $result = array(
                "masterstatus" => "error",
                "msg" => "Invalid name format. Please enter first and last name separated by a space."
            );
            echo json_encode($result);
        
        }
}

addName();



?>