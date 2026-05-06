<?php

function init()
{
    global $formConfig, $stickyForm, $acknowledgment;



    return <<<HTML
{$acknowledgment}
<div class="container mt-5">

    <h1 class="mb-4">Add Contact</h1>

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

        <!-- Render address field -->
        <div class="row">

            <div class="col-md-12">
                {$stickyForm->renderInput($formConfig['address'], 'mb-3')}
            </div>

        </div>

        <!-- Render zip code, phone, and email fields -->
        <div class="row">
            <!-- Render state select box -->
            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['city'], 'mb-3')}
            </div>

            <div class="col-md-3">
                {$stickyForm->renderSelect($formConfig['state'], 'mb-3')}
            </div>                    
            
            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['zip'], 'mb-3')}
            </div>
            
            </div>

        <div class="row">

            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['phone'], 'mb-3')}
            </div>

            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
            </div>        

            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['dob'], 'mb-3',)}
            </div>

        </div>

            <div class="col-md-3">
                {$stickyForm->renderRadio($formConfig['age'], 'mb-3', 'horizontal')}
            </div>

            <div class="col-md-3">
                {$stickyForm->renderCheckboxGroup($formConfig['contacts'], 'mb-3', 'horizontal')}
            </div>
            
        </div>

        <input type="submit" class="btn btn-primary" value="Add Contact">
<script>
  document.getElementById('fname').placeholder = 'Sen';
  document.getElementById('lname').placeholder = 'Test';
  document.getElementById('address').placeholder = '123 Anyplace';
  document.getElementById('city').placeholder = 'Somewhere';
  document.getElementById('zip').placeholder = '12345';
  document.getElementById('phone').placeholder = '123.456.7890';
  document.getElementById('email').placeholder = 'test@wccnet.edu';
  document.getElementById('dob').placeholder = '09/99/1999';
</script>
    </form>
</div>

HTML;
}
