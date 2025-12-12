<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <h2 class="mb-4 text-center">Connexion</h2>

        <!-- IMPORTANT : method="post" et action="/login" -->
        <form method="post" action="/login">
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email"
                       class="form-control"
                       id="email"
                       name="email"
                       required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password"
                       class="form-control"
                       id="password"
                       name="password"
                       required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Se connecter
            </button>
        </form>
    </div>
</div>
