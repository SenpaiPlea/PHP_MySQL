<?php
session_start();

require_once '../includes/security.php';
require_once '../includes/navigation.php';
require_once '../routes/router.php';

// Initialize variables to prevent undefined warnings
$nav = $nav ?? '';
$content = $content ?? '';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Final Project</title>
		<meta 
        http-equiv="Content-Type" 
        content="text/html; charset=utf-8" />
		<link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
	</head>
	<style>
    .nav-link {
        color: #0d6efd !important;
    }
	</style>

	<body class="container-lg">
		<?php

			$currentPage = $_GET['page'] ?? 'login';
			$publicPages = ['login'];
			
			if (!in_array($currentPage, $publicPages)) {
				echo $nav;
			}
			
			/* This is the page content  */
			echo $content; 

		?>
	</body>
</html> 