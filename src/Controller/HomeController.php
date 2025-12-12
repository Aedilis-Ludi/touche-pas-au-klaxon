<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Trajet;
use App\Core\Session;

/**
 * Contrôleur de la page d'accueil.
 */
class HomeController
{
    /**
     * Affiche la page d'accueil avec les trajets disponibles.
     *
     * @return void
     */
    public function index(): void
    {
        // On affiche uniquement les trajets avec places disponibles
        $trajets = Trajet::getPublicList();

        // Utilisateur connecté ou null
        $user = Session::getUser();

        View::render('home', [
            'title'   => 'Touche pas au klaxon',
            'trajets' => $trajets,
            'user'    => $user,
        ]);
    }
}
