<?php
require_once '../classes/Pdo_methods.php';
require_once '../classes/StickyForm.php';


$acknowledgment = '';

$formConfig = [
    'email' => [
        'type'     => 'text',
        'regex'    => 'email',
        'label'    => 'Email',
        'name'     => 'email',
        'id'       => 'email',
        'errorMsg' => 'You must enter a valid email address',
        'error'    => '',
        'required' => true,
        'value'    => 'demo@wccnet.edu'
    ],
    'password' => [
        'type'     => 'password',
        'regex'    => 'password',
        'label'    => 'Password',
        'name'     => 'password',
        'id'       => 'password',
        'errorMsg' => 'Password cannot be blank',
        'error'    => '',
        'required' => true,
        'value'    => 'password1'
    ],
];

$stickyForm = new StickyForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);

    // Only attempt login if email format passed regex
    if (empty($formConfig['email']['error']) && empty($formConfig['password']['error'])) {
        $email    = $_POST['email']    ?? '';
        $password = $_POST['password'] ?? '';

        $pdo      = new PdoMethods();
        $sql      = "SELECT id, fname, lname, password, status FROM ADMINS WHERE email = :email";
        $bindings = [[':email', $email, 'str']];
        $result   = $pdo->selectBinded($sql, $bindings);

        if ($result !== 'error' && count($result) > 0) {
            $user = $result[0];
            if (password_verify($password, $user['password'])) {
                $_SESSION['id']     = $user['id'];
                $_SESSION['fname']   = $user['fname'];
                $_SESSION['lname']   = $user['lname'];
                $_SESSION['status'] = $user['status'];
                $_SESSION['email']  = $email;
                header('Location: index.php?page=welcome'); exit;
            } else {
                // Wrong password
                $acknowledgment = 'Login credentials incorrect</p>';
            }
        } else {
            // No matching email found
            $acknowledgment = 'Login credentials incorrect</p>';
        }
    }
}
?>