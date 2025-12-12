<?php
// Variables disponibles : $title, $trajets, $user

$isConnected = !empty($user);
$isAdmin     = $isConnected && !empty($user['est_admin']);
?>

<h1 class="h4 mb-4">
    <?php if ($isConnected): ?>
        Liste des trajets disponibles
    <?php else: ?>
        Pour obtenir plus d'informations sur un trajet, veuillez vous connecter
    <?php endif; ?>
</h1>

<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>Départ</th>
            <th>Date départ</th>
            <th>Heure départ</th>
            <th>Destination</th>
            <th>Date arrivée</th>
            <th>Heure arrivée</th>
            <th>Places (dispo / total)</th>
            <?php if ($isConnected): ?>
                <th class="text-center">Actions</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($trajets as $t): ?>
        <?php
        $dateDep   = date('d/m/Y', strtotime($t['date_heure_depart']));
        $heureDep  = date('H:i',    strtotime($t['date_heure_depart']));
        $dateArr   = date('d/m/Y', strtotime($t['date_heure_arrivee']));
        $heureArr  = date('H:i',    strtotime($t['date_heure_arrivee']));
        $placesTxt = (int)$t['nb_places_disponibles'] . ' / ' . (int)$t['nb_places_total'];

        $isOwner = $isConnected && ($user['id_utilisateur'] == $t['id_utilisateur']);
        $trajetId = (int)$t['id_trajet'];
        ?>
        <tr>
            <td><?= htmlspecialchars($t['ville_depart']) ?></td>
            <td><?= htmlspecialchars($dateDep) ?></td>
            <td><?= htmlspecialchars($heureDep) ?></td>

            <td><?= htmlspecialchars($t['ville_arrivee']) ?></td>
            <td><?= htmlspecialchars($dateArr) ?></td>
            <td><?= htmlspecialchars($heureArr) ?></td>

            <td><?= htmlspecialchars($placesTxt) ?></td>

            <?php if ($isConnected): ?>
                <td class="text-center">
                    <!-- Bouton Détails (modale) pour tout le monde connecté -->
                    <button type="button"
                            class="btn btn-sm btn-info"
                            data-bs-toggle="modal"
                            data-bs-target="#trajetModal-<?= $trajetId ?>">
                        Détails
                    </button>

                    <?php if ($isAdmin): ?>
                        <!-- Admin : peut modifier n'importe quel trajet -->
                        <a href="/admin/trajets/edit?id=<?= $trajetId ?>&from=home"
                           class="btn btn-sm btn-secondary">
                            Modifier
                        </a>

                        <!-- Admin : peut supprimer n'importe quel trajet -->
                        <a href="/admin/trajets/delete?id=<?= $trajetId ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Supprimer ce trajet ?');">
                            Supprimer
                        </a>

                    <?php elseif ($isOwner): ?>
                        <!-- Employé (non admin) : ne modifie que ses trajets, pas de suppression -->
                        <a href="/trajets/edit?id=<?= $trajetId ?>&from=home"
                           class="btn btn-sm btn-secondary">
                            Modifier
                        </a>
                    <?php endif; ?>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php if ($isConnected): ?>
    <?php foreach ($trajets as $t): ?>
        <?php
        $modalId = 'trajetModal-' . (int)$t['id_trajet'];
        ?>
        <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails du trajet</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <strong>Proposé par :</strong>
                            <?= htmlspecialchars($t['prenom_contact'] . ' ' . $t['nom_contact']) ?>
                        </p>
                        <p>
                            <strong>Téléphone :</strong>
                            <?= htmlspecialchars($t['tel_contact']) ?>
                        </p>
                        <p>
                            <strong>Email :</strong>
                            <?= htmlspecialchars($t['email_contact']) ?>
                        </p>
                        <p>
                            <strong>Nombre total de places :</strong>
                            <?= (int)$t['nb_places_total'] ?>
                        </p>
                        <p>
                            <strong>Places disponibles :</strong>
                            <?= (int)$t['nb_places_disponibles'] ?>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
