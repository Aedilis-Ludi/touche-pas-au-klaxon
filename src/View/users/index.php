<?php
/**
 * @var string $title Titre de la page
 * @var array[] $users Liste des utilisateurs
 */
?>

<h1 class="h4 mb-4"><?= htmlspecialchars($title) ?></h1>

<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Téléphone</th>
        <th>Email</th>
        <th>Rôle</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= (int)$user['id_utilisateur'] ?></td>
            <td><?= htmlspecialchars($user['nom']) ?></td>
            <td><?= htmlspecialchars($user['prenom']) ?></td>
            <td><?= htmlspecialchars($user['telephone']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= !empty($user['est_admin']) ? 'Admin' : 'Employé' ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
