<?php
function init()
{
    global $admins, $message;

    $rows = '';
    if (!empty($admins)) {
        foreach ($admins as $admin) {
            $id         = htmlspecialchars($admin['id']);
            $fname      = htmlspecialchars($admin['fname']);
            $lname      = htmlspecialchars($admin['lname']);
            $email      = htmlspecialchars($admin['email']);
            $password   = htmlspecialchars($admin['password']);
            $status     = htmlspecialchars($admin['status']);

            $rows .= <<<HTML
                <tr>
                    <td>{$fname}</td>
                    <td>{$lname}</td>
                    <td>{$email}</td>
                    <td>{$password}</td>
                    <td>{$status}</td>
                    <td><input type="checkbox" name="chkbx[]" value="{$id}"></td>
                </tr>
            HTML;
        }
    } else {
        $rows = <<<HTML
            <tr>
                <td colspan="4" class="text-center">No admin records found.</td>
            </tr>
        HTML;
    }

    return <<<HTML
        <div class="container mt-5">
            <h1 class="mb-4">Delete Admin(s)</h1>
            {$message}
            <form method="POST" action="index.php?page=deleteAdmins">
                <button type="submit" name="delete" class="btn btn-danger mb-3">Delete</button>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Status</th>
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
