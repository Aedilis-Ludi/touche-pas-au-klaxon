<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Session;
use App\Model\Utilisateur;

class UserController
{
    /**
     * Vérifie que l'utilisateur connecté est admin.
     * Redirige vers l'accueil sinon.
     */
    private function requireAdmin(): void
    {
        $user = Session::getUser();

        if (!$user || empty($user['est_admin'])) {
            Session::setFlash('danger', 'Accès réservé aux administrateurs.');
            header('Location: /');
            exit;
        }
    }

    /**
     * Tableau de bord "Utilisateurs" : simple listing, aucune action CRUD.
     */
    public function index(): void
    {
        $this->requireAdmin();

        $users = Utilisateur::getAll();

        // Vue : src/View/users/index.php
        View::render('users/index', [
            'title' => 'Liste des utilisateurs',
            'users' => $users,
        ]);
    }

    /*
     * IMPORTANT :
     * Pas de méthodes create / edit / delete,
     * car le sujet demande seulement un listing des utilisateurs.
     */
}
