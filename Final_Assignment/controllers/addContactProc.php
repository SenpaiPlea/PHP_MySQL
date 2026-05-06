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
    'address' => [
        'type' => 'text',
        'regex' => 'address',
        'label' => 'Address',
        'name' => 'address',
        'id' => 'address',
        'errorMsg' => 'You must enter a valid address',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'city' => [
        'type' => 'text',
        'regex' => 'city',
        'label' => 'City',
        'name' => 'city',
        'id' => 'city',
        'errorMsg' => 'You must enter a valid city',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'state' => [
        'type'     => 'select',
        'label'    => 'State',
        'name'     => 'state',
        'id'       => 'state',
        'options'  => [
            ''   => 'Please Select a State',
            'CA' => 'California',
            'TX' => 'Texas',
            'MI' => 'Michigan',
            'NY' => 'New York',
            'FL' => 'Florida',
        ],
        'selected' => '',   // required to prevent warnings on first load
        'errorMsg' => 'You must select a state',
        'error'    => '',
        'required' => true,
        'value'    => ''
    ],
    'zip' => [
        'type' => 'text',
        'regex' => 'zip',
        'label' => 'Zip Code',
        'name' => 'zip',
        'id' => 'zip',
        'errorMsg' => 'You must enter a valid zip code in the format 12345 or 12345-6789',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'phone' => [
        'type' => 'text',
        'regex' => 'phone',
        'label' => 'Phone',
        'name' => 'phone',
        'id' => 'phone',
        'errorMsg' => 'You must enter a valid phone number in the format 123.456.7890',
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
    'dob' => [
        'type' => 'text',
        'regex' => 'dob',
        'label' => 'Date of Birth',
        'name' => 'dob',
        'id' => 'dob',
        'errorMsg' => 'You must enter a valid date of birth in the format MM/DD/YYYY',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'age' => [
        'type'     => 'radio',
        'label'    => 'Choose an Age Range',
        'name'     => 'age',
        'id'       => 'age',
        'options'  => [
            ['value' => '1', 'label' => '0-17', 'checked' => false],  // 'checked' must be initialized
            ['value' => '2', 'label' => '18-30', 'checked' => false],
            ['value' => '3', 'label' => '30-50', 'checked' => false],
            ['value' => '4', 'label' => '50+',   'checked' => false],
        ],
        'errorMsg' => 'You must select an age range',
        'error'    => '',
        'required' => true,
        'value'    => ''
    ],
    'contacts' => [
    'type'     => 'checkbox',
    'label'    => 'Select One or More Options',
    'name'     => 'contacts',
    'id'       => 'contacts',
    'options'  => [
        ['value' => 'newsletter', 'label' => 'Newsletter', 'checked' => false],  // ← same here
        ['value' => 'email',      'label' => 'Email',      'checked' => false],
        ['value' => 'text',       'label' => 'Text',       'checked' => false],
    ],
    'errorMsg' => '',
    'error'    => '',
    'required' => false,  // instructions don't say it's required
    'value'    => ''
]
];

$formConfig = $defaultConfig; // Start with default config

// Initialize form handling
$stickyForm = new StickyForm();
$pdo = new PdoMethods();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);
    if (!$stickyForm->hasErrors() && ($formConfig['masterStatus']['error'] ?? false) == false) {
        // Database operations

        // Convert contacts array to comma-separated string for database storage
        $contactsValue = '';
        if (!empty($_POST['contacts'])) {
            $contactsValue = is_array($_POST['contacts'])
                ? implode(', ', $_POST['contacts'])
                : trim($_POST['contacts']);
        } elseif (isset($formConfig['contacts']['options'])) {
            $contactsValue = implode(', ', array_column(
                array_filter($formConfig['contacts']['options'], fn($option) => !empty($option['checked'])),
                'value'
            ));
        }

        // Determine age range value based on selected radio button
        $ageValue = $formConfig['age']['value'] ?? '';


        $sql = "INSERT INTO CONTACTS (
                fname, 
                lname, 
                address, 
                city,
                state,
                zip,
                phone,
                email,
                dob,
                contacts,
                age
                )
            VALUES (
                :fname, 
                :lname, 
                :address, 
                :city,
                :state,
                :zip,
                :phone,
                :email,
                :dob,
                :contacts,
                :age
            )";


        $bindings = [
            [':fname', $formConfig['fname']['value'],       'str'],
            [':lname', $formConfig['lname']['value'],       'str'],
            [':address', $formConfig['address']['value'],   'str'],
            [':city', $formConfig['city']['value'],         'str'],
            [':state', $formConfig['state']['selected'],    'str'],
            [':zip', $formConfig['zip']['value'],           'str'],
            [':phone', $formConfig['phone']['value'],       'str'],
            [':email', $formConfig['email']['value'],       'str'],
            [':dob', $formConfig['dob']['value'],           'str'],
            [':contacts', $contactsValue,                   'str'],
            [':age', $ageValue,                             'str']
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === 'error') {
            $acknowledgment = '<p style="color: red">There was an error creating the contact</p>';
        } else {
            $acknowledgment = '<p style="color: green">Contact has been added</p>';
            // Clear form values on successful submission
            $formConfig = $defaultConfig;
        }
    }
}