<h2>Créer un trajet</h2>

<form method="post" action="">

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="id_agence_depart" class="form-label">Agence de départ</label>
            <select name="id_agence_depart" id="id_agence_depart" class="form-select" required>
                <option value="">-- Choisir --</option>
                <?php foreach ($agences as $ag): ?>
                    <option value="<?= $ag['id_agence'] ?>">
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
                    <option value="<?= $ag['id_agence'] ?>">
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
                   required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="date_heure_arrivee">Date et heure d’arrivée</label>
            <input type="datetime-local"
                   name="date_heure_arrivee"
                   id="date_heure_arrivee"
                   class="form-control"
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
                   required>
        </div>
        <div class="col-md-6 d-flex align-items-end">
            <p class="mb-0">
                Les places disponibles seront initialisées avec le même nombre.
            </p>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="/" class="btn btn-secondary">Annuler</a>
</form>
