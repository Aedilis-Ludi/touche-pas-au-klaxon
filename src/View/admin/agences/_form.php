<?php
// agence peut être défini (edit) ou non (create)
$nomVille = isset($agence) ? $agence['nom_ville'] : '';
?>

<div class="mb-3">
    <label for="nom_ville" class="form-label">Ville</label>
    <input
        type="text"
        name="nom_ville"
        id="nom_ville"
        class="form-control"
        value="<?= htmlspecialchars($nomVille) ?>"
        required
    >
</div>
