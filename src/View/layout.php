<?php
// Variables disponibles : $title, $flash, $user, $view
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= htmlspecialchars($title) ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- CSS compilé depuis Sass -->
    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="d-flex flex-column min-vh-100">

<header class="mb-4">
    <?php include __DIR__ . '/partials/header.php'; ?>
</header>

<main class="container mb-4">
    <?php include __DIR__ . '/partials/flash.php'; ?>
    <?php include __DIR__ . '/' . $view . '.php'; ?>
</main>

<footer class="mt-auto text-center py-3 border-top">
    © 2024 – CENEF – MVC PHP
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
