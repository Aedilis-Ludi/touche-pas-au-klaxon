<?php

use App\Core\Session;

// Récupère l'utilisateur connecté (ou null)
$user = Session::getUser();

// Vérifie si l'utilisateur est administrateur
$isAdmin = $user && isset($user['est_admin']) && (int)$user['est_admin'] === 1;
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom mb-4">
    <div class="container-fluid">

        <!-- Logo / Nom de l'application -->
        <a class="navbar-brand fw-semibold" href="/">
            Touche pas au klaxon
        </a>

        <div class="ms-auto d-flex align-items-center gap-2">

            <?php if (!$user): ?>

                <!-- VISITEUR NON CONNECTÉ -->
                <a href="/login" class="btn btn-outline-primary">
                    Connexion
                </a>

            <?php elseif ($isAdmin): ?>

                <!-- ADMIN CONNECTÉ -->
                <a href="/admin/users" class="btn btn-secondary">
                    Utilisateurs
                </a>

                <a href="/admin/agences" class="btn btn-secondary">
                    Agences
                </a>

                <a href="/admin/trajets" class="btn btn-secondary">
                    Trajets
                </a>

                <span class="mx-2 fw-semibold">
                    Bonjour <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?>
                </span>

                <a href="/logout" class="btn btn-outline-danger">
                    Déconnexion
                </a>

            <?php else: ?>

                <!-- UTILISATEUR CONNECTÉ (non admin) -->
                <a href="/trajets/create" class="btn btn-primary">
                    Créer un trajet
                </a>

                <span class="mx-2 fw-semibold">
                    <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?>
                </span>

                <a href="/logout" class="btn btn-outline-danger">
                    Déconnexion
                </a>

            <?php endif; ?>

        </div>
    </div>
</nav>
