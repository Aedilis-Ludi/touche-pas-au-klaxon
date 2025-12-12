<h2>Créer un trajet</h2>

<form method="post" action="">
    <div class="mb-3">
        <label class="form-label">Agence de départ</label>
        <select name="id_agence_depart" class="form-select" required>
            <option value="">-- Choisir --</option>
            <?php foreach ($agences as $a): ?>
                <option value="<?= $a['id_agence'] ?>">
                    <?= htmlspecialchars($a['nom_ville']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Agence d'arrivée</label>
        <select name="id_agence_arrivee" class="form-select" required>
            <option value="">-- Choisir --</option>
            <?php foreach ($agences as $a): ?>
                <option value="<?= $a['id_agence'] ?>">
                    <?= htmlspecialchars($a['nom_ville']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Date et heure de départ</label>
        <input type="datetime-local" name="date_heure_depart" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Date et heure d’arrivée</label>
        <input type="datetime-local" name="date_heure_arrivee" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nombre de places</label>
        <input type="number" name="nb_places_total" min="1" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="/" class="btn btn-secondary">Annuler</a>
</form>
