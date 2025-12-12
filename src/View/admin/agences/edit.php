<h2>Modifier une agence</h2>

<form method="post" action="/admin/agences/edit?id=<?= htmlspecialchars($agence['id_agence']) ?>">
    <?php
    // Ici $agence est défini (transmis par le contrôleur)
    include __DIR__ . '/_form.php';
    ?>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="/admin/agences" class="btn btn-secondary">Annuler</a>
</form>
