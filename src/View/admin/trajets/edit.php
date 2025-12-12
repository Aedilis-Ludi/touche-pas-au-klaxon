<?php
// Variables : $trajet, $agences, $from
$from    = $from ?? 'admin';
$backUrl = ($from === 'home') ? '/' : '/admin/trajets';

$valueDepart  = date('Y-m-d\TH:i', strtotime($trajet['date_heure_depart']));
$valueArrivee = date('Y-m-d\TH:i', strtotime($trajet['date_heure_arrivee']));
?>

<h2>Modifier un trajet</h2>

<form method="post" action="">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="id_agence_depart" class="form-label">Agence de départ</label>
            <select name="id_agence_depart" id="id_agence_depart" class="form-select" required>
                <option value="">-- Choisir --</option>
                <?php foreach ($agences as $ag): ?>
                    <option value="<?= (int)$ag['id_agence'] ?>"
                        <?= $ag['id_agence'] == $trajet['id_agence_depart'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($ag['nom_ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label for="id_agence_arrivee" class="form-label">Agence d’arrivée</label>
            <select name="id_agence_arrivee" id="id_agence_arrivee" class="form-select" required>
                <option value="">-- Choisir --</option>
                <?php foreach ($agences as $ag): ?>
                    <option value="<?= (int)$ag['id_agence'] ?>"
                        <?= $ag['id_agence'] == $trajet['id_agence_arrivee'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($ag['nom_ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label" for="date_heure_depart">Date et heure de départ</label>
            <input type="datetime-local"
                   name="date_heure_depart"
                   id="date_heure_depart"
                   class="form-control"
                   value="<?= htmlspecialchars($valueDepart) ?>"
                   required>
        </div>

        <div class="col-md-6">
            <label class="form-label" for="date_heure_arrivee">Date et heure d’arrivée</label>
            <input type="datetime-local"
                   name="date_heure_arrivee"
                   id="date_heure_arrivee"
                   class="form-control"
                   value="<?= htmlspecialchars($valueArrivee) ?>"
                   required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label" for="nb_places_total">Places totales</label>
            <input type="number"
                   min="1"
                   name="nb_places_total"
                   id="nb_places_total"
                   class="form-control"
                   value="<?= (int)$trajet['nb_places_total'] ?>"
                   required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="nb_places_disponibles">Places disponibles</label>
            <input type="number"
                   min="0"
                   name="nb_places_disponibles"
                   id="nb_places_disponibles"
                   class="form-control"
                   value="<?= (int)$trajet['nb_places_disponibles'] ?>"
                   required>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="<?= $backUrl ?>" class="btn btn-secondary">Annuler</a>
</form>
