<?php

// Pages that don't require authentication
$publicPages = ['login'];

// Get current page from router
$currentPage = $_GET['page'] ?? 'login';

// Check if user is logged in
$isLoggedIn = isset($_SESSION['id']) && isset($_SESSION['status']);

// Redirect to login if accessing protected page while not logged in
if (!$isLoggedIn && !in_array($currentPage, $publicPages)) {
    header('Location: index.php?page=login');
    exit;
}

$adminOnlyPages = ['addAdmin', 'deleteAdmins'];
if (in_array($currentPage, $adminOnlyPages) && ($_SESSION['status'] ?? '') !== 'admin') {
    header('Location: index.php?page=login'); exit;
}

?>