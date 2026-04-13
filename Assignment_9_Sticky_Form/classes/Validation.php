<?php

/* 
Error messages:

You must enter a first name and it must be alpha characters only.

You must enter a last name and it must be alpha characters only.

You must enter a email address and it must be in the format of example@example.com.

Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)

You have been added to the database

There is already a record with that emoail
*/

class Validation
{

private $patterns = [
        'name' => "/^[a-zA-Z]+$/",
        'email' => "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
        'password' => "/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"
    ];
     private $errors = [];
    
    public function checkFormat($value, $regexKey, $customErrorMsg) {
        $regex = $this->patterns[$regexKey];

        if (!preg_match($regex, $value)) {
            $this->errors[$regexKey] = $customErrorMsg ?? "Invalid format.";
            return false;
        }
        return true;
    }
    
    public function getErrors() {
        return $this->errors;
    }
    
    public function hasErrors() {
        return !empty($this->errors);
    }

}

?>