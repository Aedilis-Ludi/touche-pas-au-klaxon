<?php
/**
 * @var string  $title     Titre de la page
 * @var array[] $agences   Liste des agences
 */
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Gestion des agences</h2>

    <a href="/admin/agences/create" class="btn btn-primary">
        + Nouvelle agence
    </a>
</div>

<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Ville</th>
            <th class="text-center" style="width: 160px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($agences as $ag): ?>
        <tr>
            <td><?= (int)$ag['id_agence'] ?></td>
            <td><?= htmlspecialchars($ag['nom_ville']) ?></td>
            <td class="text-center">
                <a href="/admin/agences/edit?id=<?= urlencode($ag['id_agence']) ?>"
                   class="btn btn-sm btn-secondary">
                    Modifier
                </a>
                <a href="/admin/agences/delete?id=<?= urlencode($ag['id_agence']) ?>"
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Supprimer cette agence ?');">
                    Supprimer
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
