<h2>Gestion des trajets</h2>

<div class="mb-3">
    <a href="/admin/trajets/create" class="btn btn-primary">
        + Nouveau trajet
    </a>
</div>

<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
    <tr>
        <th>ID</th>
        <th>Départ</th>
        <th>Date départ</th>
        <th>Heure départ</th>
        <th>Destination</th>
        <th>Date arrivée</th>
        <th>Heure arrivée</th>
        <th>Places (dispo / total)</th>
        <th class="text-center" style="width: 170px;">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($trajets as $t): ?>
        <?php
        $dtDep = new DateTime($t['date_heure_depart']);
        $dtArr = new DateTime($t['date_heure_arrivee']);
        ?>
        <tr>
            <td><?= (int)$t['id_trajet'] ?></td>
            <td><?= htmlspecialchars($t['ville_depart']) ?></td>
            <td><?= $dtDep->format('d/m/Y') ?></td>
            <td><?= $dtDep->format('H:i') ?></td>
            <td><?= htmlspecialchars($t['ville_arrivee']) ?></td>
            <td><?= $dtArr->format('d/m/Y') ?></td>
            <td><?= $dtArr->format('H:i') ?></td>
            <td>
                <?= (int)$t['nb_places_disponibles'] ?>
                /
                <?= (int)$t['nb_places_total'] ?>
            </td>
            <td class="text-center">
                <a href="/admin/trajets/edit?id=<?= urlencode($t['id_trajet']) ?>"
                   class="btn btn-sm btn-secondary">
                    Modifier
                </a>
                <a href="/admin/trajets/delete?id=<?= urlencode($t['id_trajet']) ?>"
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Supprimer ce trajet ?');">
                    Supprimer
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
