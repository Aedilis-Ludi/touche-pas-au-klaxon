<?php

namespace App\Core;

/**
 * Gestionnaire d'affichage des vues.
 *
 * Cette classe centralise le rendu des templates en injectant les données
 * nécessaires et en incluant automatiquement le layout principal.
 */
class View
{
    /**
     * Rend une vue en lui transmettant des paramètres.
     *
     * Le fonctionnement est le suivant :
     * - Récupération du message flash éventuel.
     * - Récupération de l'utilisateur connecté.
     * - Définition du titre de la page (valeur par défaut : "Touche pas au klaxon").
     * - Extraction des variables pour les rendre accessibles dans la vue.
     * - Inclusion du layout global contenant le template final.
     *
     * @param string $template Nom du fichier de vue à charger (sans extension).
     * @param array<string,mixed> $params Données passées à la vue.
     *
     * @return void
     */
    public static function render(string $template, array $params = []): void
    {
        $flash   = Session::getFlash();
        $user    = Session::getUser();
        $title   = $params['title'] ?? 'Touche pas au klaxon';
        $view    = $template;

        extract($params);

        require __DIR__ . '/../View/layout.php';
    }
}
