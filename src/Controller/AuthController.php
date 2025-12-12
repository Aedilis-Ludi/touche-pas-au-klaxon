<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Session;
use App\Model\Utilisateur;

/**
 * Contrôleur d'authentification.
 */
class AuthController
{
    /**
     * Connexion (affichage + traitement).
     *
     * @return void
     */
    public function login(): void
    {
        // Si l'utilisateur est déjà connecté, on le renvoie vers l'accueil
        if (Session::getUser()) {
            header('Location: /');
            exit;
        }

        // Si le formulaire est soumis (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // On récupère les valeurs envoyées par le formulaire
            $email    = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';

            // Petite vérification basique : champs vides
            if ($email === '' || $password === '') {
                Session::setFlash('danger', 'Veuillez remplir tous les champs.');

                // On ré-affiche simplement la page avec le message d’erreur
                View::render('auth/login', [
                    'title' => 'Connexion',
                ]);
                return;
            }

            // On va chercher l'utilisateur par son email
            $user = Utilisateur::findByEmail($email);

            //  Pour l'instant le mot de passe est en clair dans la BDD (azerty)
            //  Plus tard, on pourrait utiliser password_hash() / password_verify()
            if ($user && $user['mot_de_passe'] === $password) {

                // On sauvegarde l'utilisateur en session
                // (le helper setUser() se charge de stocker ça dans $_SESSION)
                Session::setUser($user);
                Session::setFlash('success', 'Connexion réussie !');

                header('Location: /');
                exit;
            }

            // Mauvais identifiants
            Session::setFlash('danger', 'Email ou mot de passe incorrect.');
        }

        // Affichage du formulaire (GET initial OU après erreur)
        View::render('auth/login', [
            'title' => 'Connexion',
        ]);
    }

    /**
     * Déconnexion.
     *
     * @return void
     */
    public function logout(): void
    {
        // On supprime toutes les données de session
        Session::destroy();

        // Message de confirmation
        Session::setFlash('success', 'Vous avez été déconnecté.');

        // On retourne sur la page d'accueil
        header('Location: /');
        exit;
    }
}
