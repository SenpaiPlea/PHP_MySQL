<?php

function init()
{
    global $formConfig, $stickyForm, $acknowledgment;
    return <<<HTML
{$acknowledgment}
<div class="container mt-5">
    <h1 class="mb-4">Add Administrator</h1>
    <form method="post" action="">
        
        <div class="row">
            <!-- Render first name field -->
            <div class="col-md-6">
                {$stickyForm->renderInput($formConfig['fname'], 'mb-3')}
            </div>
            <!-- Render last name field -->
            <div class="col-md-6">
                {$stickyForm->renderInput($formConfig['lname'], 'mb-3')}
            </div>
        </div>

        <div class="row">
            <!-- Render email field -->
            <div class="col-md-6">
                {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
            </div>
            <!-- Render password field -->
            <div class="col-md-6">
                {$stickyForm->renderPassword($formConfig['password'], 'mb-3')}
            </div>
        </div>

        <div class="row">
            <!-- Render status select box -->
            <div class="col-md-6">
                {$stickyForm->renderSelect($formConfig['status'], 'mb-3')}
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Add Administrator">

        <script>
            document.getElementById('fname').placeholder = 'Jane';
            document.getElementById('lname').placeholder = 'Smith';
            document.getElementById('email').placeholder = 'jane@wccnet.edu';
            document.getElementById('password').placeholder = 'Enter a password';
        </script>

    </form>
</div>
HTML;
}