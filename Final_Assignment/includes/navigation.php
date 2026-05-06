<?php
$nav = <<<HTML
    <nav class="navbar navbar-expand-xl navbar-light bg-light" >
        <a class="navbar-brand" href=""></a>
        <div class="collapse navbar-collapse" >
            <ul class="navbar-nav mr-auto" >

                <li class="nav-item" >
                    <a class="nav-link" href="index.php?page=addContact">Add Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=deleteContacts">Delete contact(s)</a>
                </li>
HTML;

if (isset($_SESSION['status']) && $_SESSION['status'] === 'admin') {
    $nav .= <<<HTML
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=addAdmin">Add Admin</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=deleteAdmins">Delete Admin(s)</a>
                </li>
HTML;
}

$nav .= <<<HTML
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=logout">Logout</a>
                </li>

            </ul>
        </div>
    </nav>
HTML;

?>