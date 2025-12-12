<h2>Créer une agence</h2>

<form method="post" action="/admin/agences/create">
    <?php
    // $agence n’existe pas ici (création)
    include __DIR__ . '/_form.php';
    ?>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="/admin/agences" class="btn btn-secondary">Annuler</a>
</form>
