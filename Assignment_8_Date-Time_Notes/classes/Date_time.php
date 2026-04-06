<?php
require_once "classes/Pdo_methods.php";

class Date_time {
    // Class implementation

private $PdoMethods;

public function __construct() {
    $this->PdoMethods = new PdoMethods();
    $this->PdoMethods->dbOpen();
}

    public function checkSubmit() {
        // Method implementation
        if (isset($_POST["addNote"])) {
            if (empty($_POST["dateTime"]) || empty($_POST["note"])) {
                return "Please enter a date, time, and note.";
            } else {
                $timestamp = strtotime($_POST["dateTime"]);
                $sql = "INSERT INTO NOTES (timestamp, note) 
                        VALUES (:timestamp, :note)";
                $bindings = [
                    [':timestamp', $timestamp, 'int'],
                    [':note', $_POST["note"], 'str']
                ];
                $this->PdoMethods->otherBinded($sql, $bindings);
                return "Successfully added note.";
            }
    }

    elseif (isset($_POST["getNotes"])) {
        if (empty($_POST["begDate"]) || empty($_POST["endDate"])) {
            return "Please enter a beginning and end date.";
        } else {
            $sql = "SELECT timestamp, note FROM NOTES WHERE timestamp BETWEEN :begDate AND :endDate ORDER BY timestamp DESC";
            $bindings = [
                [':begDate', strtotime($_POST["begDate"]), 'int'],
                [':endDate', strtotime($_POST["endDate"]) + 86399, 'int'] // Adding 86399 seconds to get the end of the day
            ];
            $result = $this->PdoMethods->selectBinded($sql, $bindings);

            if (empty($result)) {
                return "No notes found for the date range selected.";
                } else {
                    $output = "<table class='table table-bordered table-striped'>";
                    $output .= "<thead><tr><th>Date and Time</th><th>Note</th></tr></thead><tbody>";
                    foreach ($result as $row) {
                        $row['timestamp'] = date('m/d/Y h:i a', $row['timestamp']);
                        $time = htmlspecialchars($row['timestamp']);
                        $note = htmlspecialchars($row['note']);
                        $output .= "<tr><td>{$time}</td><td>{$note}</td></tr>";
                    }
                    $output .= "</table>";
                    return $output;
                }
        }
    }
}



}

?>