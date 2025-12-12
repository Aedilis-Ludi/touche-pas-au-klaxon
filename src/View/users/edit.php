<?php
/**
 * @var array  $user  Utilisateur à éditer
 * @var string $title Titre de la page
 */
?>

<h2>Modifier un utilisateur</h2>

<form method="post"
      action="/admin/users/edit?id=<?= htmlspecialchars($user['id_utilisateur']) ?>">
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text"
               name="nom"
               class="form-control"
               value="<?= htmlspecialchars($user['nom']) ?>"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Prénom</label>
        <input type="text"
               name="prenom"
               class="form-control"
               value="<?= htmlspecialchars($user['prenom']) ?>"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Téléphone</label>
        <input type="text"
               name="telephone"
               class="form-control"
               value="<?= htmlspecialchars($user['telephone']) ?>"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email"
               name="email"
               class="form-control"
               value="<?= htmlspecialchars($user['email']) ?>"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="text"
               name="mot_de_passe"
               class="form-control"
               value="<?= htmlspecialchars($user['mot_de_passe']) ?>"
               required>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input"
               type="checkbox"
               name="est_admin"
               id="est_admin"
               <?= !empty($user['est_admin']) ? 'checked' : '' ?>>
        <label class="form-check-label" for="est_admin">
            Administrateur
        </label>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="/admin/users" class="btn btn-secondary">Annuler</a>
</form>
