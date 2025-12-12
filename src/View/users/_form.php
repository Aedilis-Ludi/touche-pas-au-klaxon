<?php
// $user peut être défini ou non (create vs edit)
$nom          = $user['nom']          ?? '';
$prenom       = $user['prenom']       ?? '';
$telephone    = $user['telephone']    ?? '';
$email        = $user['email']        ?? '';
$mot_de_passe = $user['mot_de_passe'] ?? '';
$est_admin    = !empty($user['est_admin']);
?>

<div class="mb-3">
    <label class="form-label" for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom"
           value="<?= htmlspecialchars($nom) ?>" required>
</div>

<div class="mb-3">
    <label class="form-label" for="prenom">Prénom</label>
    <input type="text" class="form-control" id="prenom" name="prenom"
           value="<?= htmlspecialchars($prenom) ?>" required>
</div>

<div class="mb-3">
    <label class="form-label" for="telephone">Téléphone</label>
    <input type="text" class="form-control" id="telephone" name="telephone"
           value="<?= htmlspecialchars($telephone) ?>">
</div>

<div class="mb-3">
    <label class="form-label" for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email"
           value="<?= htmlspecialchars($email) ?>" required>
</div>

<div class="mb-3">
    <label class="form-label" for="mot_de_passe">Mot de passe</label>
    <input type="text" class="form-control" id="mot_de_passe" name="mot_de_passe"
           value="<?= htmlspecialchars($mot_de_passe) ?>" required>
</div>

<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" id="est_admin" name="est_admin"
        <?= $est_admin ? 'checked' : '' ?>>
    <label class="form-check-label" for="est_admin">
        Administrateur ?
    </label>
</div>
