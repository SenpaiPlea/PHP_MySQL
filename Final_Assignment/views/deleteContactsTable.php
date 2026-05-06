<?php
function init()
{
    global $contacts, $message, $ageRanges;
    $rows = '';
    if (!empty($contacts)) {
        foreach ($contacts as $contact) {
            $id             = htmlspecialchars($contact['id']);
            $fname          = htmlspecialchars($contact['fname']);
            $lname          = htmlspecialchars($contact['lname']);
            $address        = htmlspecialchars($contact['address']);
            $city           = htmlspecialchars($contact['city']);
            $state          = htmlspecialchars($contact['state']);
            $zip            = htmlspecialchars($contact['zip']);
            $phone          = htmlspecialchars($contact['phone']);
            $email          = htmlspecialchars($contact['email']);
            $dob            = htmlspecialchars($contact['dob']);
            $contactsTable  = htmlspecialchars($contact['contacts']);
            $age            = htmlspecialchars($ageRanges[$contact['age']] ?? $contact['age']);

            $rows .= <<<HTML
                <tr>
                    <td>{$fname}</td>
                    <td>{$lname}</td>
                    <td>{$address}</td>
                    <td>{$city}</td>
                    <td>{$state}</td>
                    <td>{$zip}</td>
                    <td>{$phone}</td>
                    <td>{$email}</td>
                    <td>{$dob}</td>
                    <td>{$contactsTable}</td>
                    <td>{$age}</td>
                    <td><input type="checkbox" name="chkbx[]" value="{$id}"></td>
                </tr>
            HTML;
        }
    } else {
        $rows = <<<HTML
            <tr>
                <td colspan="12" class="text-center">No contact records found.</td>
            </tr>
        HTML;
    }
    return <<<HTML
        <div class="container mt-5">
            <h1 class="mb-4">Delete Contact(s)</h1>
            {$message}
            <form method="POST" action="index.php?page=deleteContacts">
                <button type="submit" name="delete" class="btn btn-danger mb-3">Delete</button>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Contacts</th>
                            <th>Age Range</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        {$rows}
                    </tbody>
                </table>
            </form>
        </div>
HTML;
}