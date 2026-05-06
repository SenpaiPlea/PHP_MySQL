<?php


function init()
{
    global $formConfig, $stickyForm, $acknowledgment;

    $acknowledgmentHtml = '';
    if (!empty($acknowledgment)) {
        $acknowledgmentHtml = "{$acknowledgment}";
    }

    return <<<HTML
        <p>&nbsp;</p>
        {$acknowledgmentHtml}
        <div class="container mt-5">
            <h1 class="mb-4">Login</h1>
            <form method="post" action="index.php?page=login">
                <div class="row">
                    <div class="col-md-6">
                        {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {$stickyForm->renderPassword($formConfig['password'], 'mb-3')}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
HTML;
}
?>