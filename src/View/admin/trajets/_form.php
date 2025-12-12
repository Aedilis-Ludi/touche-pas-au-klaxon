<?php
// $trajet peut être null en création
$isEdit = isset($trajet);
?>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="id_agence_depart" class="form-label">Agence de départ</label>
        <select name="id_agence_depart" id="id_agence_depart" class="form-select" required>
            <option value="">-- Choisir --</option>
            <?php foreach ($agences as $ag): ?>
                <option value="<?= $ag['id_agence'] ?>"
                    <?= $isEdit && $ag['id_agence'] == $trajet['id_agence_depart'] ? 'selected' : '' ?>>
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
                <option value="<?= $ag['id_agence'] ?>"
                    <?= $isEdit && $ag['id_agence'] == $trajet['id_agence_arrivee'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($ag['nom_ville']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <label class="form-label" for="date_depart">Date départ</label>
        <input type="date" name="date_depart" id="date_depart" class="form-control"
               value="<?= $isEdit ? substr($trajet['date_depart'], 0, 10) : '' ?>" required>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="heure_depart">Heure départ</label>
        <input type="time" name="heure_depart" id="heure_depart" class="form-control"
               value="<?= $isEdit ? substr($trajet['heure_depart'], 0, 5) : '' ?>" required>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="date_arrivee">Date arrivée</label>
        <input type="date" name="date_arrivee" id="date_arrivee" class="form-control"
               value="<?= $isEdit ? substr($trajet['date_arrivee'], 0, 10) : '' ?>" required>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="heure_arrivee">Heure arrivée</label>
        <input type="time" name="heure_arrivee" id="heure_arrivee" class="form-control"
               value="<?= $isEdit ? substr($trajet['heure_arrivee'], 0, 5) : '' ?>" required>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label" for="nb_places_total">Places totales</label>
        <input type="number" min="1" name="nb_places_total" id="nb_places_total" class="form-control"
               value="<?= $isEdit ? (int)$trajet['nb_places_total'] : '' ?>" required>
    </div>

    <div class="col-md-6">
        <label class="form-label" for="nb_places_disponibles">Places disponibles</label>
        <input type="number" min="0" name="nb_places_disponibles" id="nb_places_disponibles" class="form-control"
               value="<?= $isEdit ? (int)$trajet['nb_places_disponibles'] : '' ?>"
               <?= $isEdit ? '' : 'readonly' ?>>
        <?php if (!$isEdit): ?>
            <div class="form-text">
                En création, les places dispo seront égales aux places totales.
            </div>
        <?php endif; ?>
    </div>
</div>
