<?php
$path = "index.php?page=login";

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case "addAdmin":
            require_once('../controllers/addAdminProc.php');
            require_once('../views/addAdminForm.php');
            $content = init();
            break;

        case "addContact":
            require_once('../controllers/addContactProc.php');
            require_once('../views/addContactForm.php');
            $content = init();
            break;

        case "deleteAdmins":
            require_once('../controllers/deleteAdminProc.php');
            require_once('../views/deleteAdminsTable.php');
            $content = init();
            break;

        case "deleteContacts":
            require_once('../controllers/deleteContactProc.php');
            require_once('../views/deleteContactsTable.php');
            $content = init();
            break;

        case "login":
            require_once('../controllers/loginProc.php');
            require_once('../views/loginForm.php');
            $content = init();
            break;

        case "logout":
            require_once('../views/logout.php');
            $content = init();
            break;

        case "welcome":
            require_once('../views/welcome.php');
            $content = init();
            break;

        default:
            header('Location: ' . $path);
            exit;
    }
} else {
    header('Location: ' . $path);
    exit;
}




?>