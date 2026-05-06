<?php
require_once('../classes/StickyForm.php');
require_once('../classes/Pdo_methods.php');

$acknowledgment = "<p></p>"; // Placeholder for messages

// Form configuration array
$defaultConfig = [
    'fname' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => 'First Name',
        'name' => 'fname',
        'id' => 'fname',
        'errorMsg' => 'You must enter a valid first name',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'lname' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => 'Last Name',
        'name' => 'lname',
        'id' => 'lname',
        'errorMsg' => 'You must enter a valid last name',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => 'Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email address',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'password' => [
        'type' => 'password',
        'regex' => 'password',
        'label' => 'Password',
        'name' => 'password',
        'id' => 'password',
        'errorMsg' => 'Password cannot be blank',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'status' => [
        'type' => 'select',
        'label' => 'Status',
        'name' => 'status',
        'id' => 'status',
        'errorMsg' => 'You must select a status',
        'error' => '',
        'required' => true,
        'value' => '',
        'selected' => '',
        'options' => [
            '' => 'Please Select a Status',
            'staff' => 'Staff',
            'admin' => 'Admin'
        ]
    ]
];

$formConfig = $defaultConfig; // Start with default config

// Initialize form handling
$stickyForm = new StickyForm();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);
    if (!$stickyForm->hasErrors() && ($formConfig['masterStatus']['error'] ?? false) == false) {
        // Database operations

        $pdo = new PdoMethods();

        $hashedPassword = password_hash($formConfig['password']['value'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO ADMINS (
                fname, 
                lname, 
                email,
                password,
                status
                )
            VALUES (
                :fname, 
                :lname, 
                :email,
                :password,
                :status
            )";


        $bindings = [
            [':fname', $formConfig['fname']['value'],       'str'],
            [':lname', $formConfig['lname']['value'],       'str'],
            [':email', $formConfig['email']['value'],       'str'],
            [':password', $hashedPassword,                  'str'],
            [':status', $formConfig['status']['selected'],  'str'],
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === 'error') {
            $acknowledgment = '<p style="color: red">There was an error creating the admin</p>';
        } else {
            $acknowledgment = '<p style="color: green">Administrator added</p>';
            // Clear form values on successful submission
            $formConfig = $defaultConfig;
        }
    }
}
