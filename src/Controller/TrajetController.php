<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Session;
use App\Model\Trajet;
use App\Model\Agence;

/**
 * Contrôleur des trajets.
 */
class TrajetController
{
    /**
     * Liste des trajets (admin).
     *
     * @return void
     */
    public function adminIndex(): void
    {
        $user = Session::getUser();
        if (!$user || empty($user['est_admin'])) {
            Session::setFlash('danger', 'Accès réservé aux administrateurs.');
            header('Location: /');
            exit;
        }

        $trajets = Trajet::getAll();

        View::render('admin/trajets/index', [
            'title'   => 'Gestion des trajets',
            'trajets' => $trajets,
        ]);
    }

    /**
     * Création d’un trajet.
     *
     * @return void
     */
    public function create(): void
    {
        $user = Session::getUser();
        if (!$user) {
            Session::setFlash('danger', 'Vous devez être connecté pour créer un trajet.');
            header('Location: /login');
            exit;
        }

        $agences = Agence::getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $idUtilisateur = (int)$user['id_utilisateur'];
            $idDepart      = (int)($_POST['id_agence_depart']  ?? 0);
            $idArrivee     = (int)($_POST['id_agence_arrivee'] ?? 0);
            $dateInputDep  = $_POST['date_heure_depart']  ?? '';
            $dateInputArr  = $_POST['date_heure_arrivee'] ?? '';
            $nbTotal       = (int)($_POST['nb_places_total']   ?? 0);

            $tsDep = $dateInputDep ? strtotime($dateInputDep) : false;
            $tsArr = $dateInputArr ? strtotime($dateInputArr) : false;

            $erreur = null;

            if ($idDepart <= 0 || $idArrivee <= 0) {
                $erreur = 'Les agences de départ et d’arrivée sont obligatoires.';
            } elseif ($idDepart === $idArrivee) {
                $erreur = 'L’agence de départ et l’agence d’arrivée doivent être différentes.';
            } elseif (!$tsDep || !$tsArr) {
                $erreur = 'Les dates/horaires de départ et d’arrivée sont invalides.';
            } elseif ($tsArr <= $tsDep) {
                $erreur = 'On ne peut pas arriver avant l’heure de départ.';
            } elseif ($nbTotal <= 0) {
                $erreur = 'Le nombre total de places doit être supérieur à 0.';
            }

            if ($erreur !== null) {
                Session::setFlash('danger', $erreur);
            } else {
                $dateDepartSql  = date('Y-m-d H:i:s', $tsDep);
                $dateArriveeSql = date('Y-m-d H:i:s', $tsArr);

                $data = [
                    'id_utilisateur'        => $idUtilisateur,
                    'id_agence_depart'      => $idDepart,
                    'id_agence_arrivee'     => $idArrivee,
                    'date_heure_depart'     => $dateDepartSql,
                    'date_heure_arrivee'    => $dateArriveeSql,
                    'nb_places_total'       => $nbTotal,
                    'nb_places_disponibles' => $nbTotal,
                ];

                if (Trajet::create($data)) {
                    Session::setFlash('success', 'Trajet créé avec succès.');

                    if (!empty($user['est_admin'])) {
                        header('Location: /admin/trajets');
                    } else {
                        header('Location: /');
                    }
                    exit;
                }

                Session::setFlash('danger', 'Erreur lors de la création du trajet.');
            }
        }

        View::render('trajets/create', [
            'title'   => 'Créer un trajet',
            'agences' => $agences,
        ]);
    }

    /**
     * Édition d’un trajet.
     *
     * @param int $id Identifiant du trajet.
     * @return void
     */
    public function edit(int $id): void
    {
        $user = Session::getUser();
        if (!$user) {
            Session::setFlash('danger', 'Vous devez être connecté pour modifier un trajet.');
            header('Location: /login');
            exit;
        }

        if ($id <= 0) {
            Session::setFlash('danger', 'Trajet invalide.');
            header('Location: /');
            exit;
        }

        $trajet = Trajet::find($id);
        if (!$trajet) {
            Session::setFlash('danger', 'Trajet introuvable.');
            header('Location: /');
            exit;
        }

        $isAdmin  = !empty($user['est_admin']);
        $isAuthor = ($trajet['id_utilisateur'] == $user['id_utilisateur']);

        if (!$isAdmin && !$isAuthor) {
            Session::setFlash('danger', 'Vous ne pouvez modifier que vos propres trajets.');
            header('Location: /');
            exit;
        }

        $agences = Agence::getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $idDepart      = (int)($_POST['id_agence_depart']  ?? 0);
            $idArrivee     = (int)($_POST['id_agence_arrivee'] ?? 0);
            $dateInputDep  = $_POST['date_heure_depart']  ?? '';
            $dateInputArr  = $_POST['date_heure_arrivee'] ?? '';
            $nbTotal       = (int)($_POST['nb_places_total']       ?? 0);
            $nbDispo       = (int)($_POST['nb_places_disponibles'] ?? 0);

            $tsDep = $dateInputDep ? strtotime($dateInputDep) : false;
            $tsArr = $dateInputArr ? strtotime($dateInputArr) : false;

            $erreur = null;

            if ($idDepart <= 0 || $idArrivee <= 0) {
                $erreur = 'Les agences de départ et d’arrivée sont obligatoires.';
            } elseif ($idDepart === $idArrivee) {
                $erreur = 'L’agence de départ et l’agence d’arrivée doivent être différentes.';
            } elseif (!$tsDep || !$tsArr) {
                $erreur = 'Les dates/horaires de départ et d’arrivée sont invalides.';
            } elseif ($tsArr <= $tsDep) {
                $erreur = 'On ne peut pas arriver avant l’heure de départ.';
            } elseif ($nbTotal <= 0) {
                $erreur = 'Le nombre total de places doit être supérieur à 0.';
            } elseif ($nbDispo < 0 || $nbDispo > $nbTotal) {
                $erreur = 'Le nombre de places disponibles doit être compris entre 0 et le total.';
            }

            if ($erreur !== null) {
                Session::setFlash('danger', $erreur);
            } else {
                $dateDepartSql  = date('Y-m-d H:i:s', $tsDep);
                $dateArriveeSql = date('Y-m-d H:i:s', $tsArr);

                $data = [
                    'id_agence_depart'      => $idDepart,
                    'id_agence_arrivee'     => $idArrivee,
                    'date_heure_depart'     => $dateDepartSql,
                    'date_heure_arrivee'    => $dateArriveeSql,
                    'nb_places_total'       => $nbTotal,
                    'nb_places_disponibles' => $nbDispo,
                ];

                if (Trajet::update($id, $data)) {
                    Session::setFlash('success', 'Trajet modifié avec succès.');

                    if ($isAdmin) {
                        header('Location: /admin/trajets');
                    } else {
                        header('Location: /');
                    }
                    exit;
                }

                Session::setFlash('danger', 'Erreur lors de la modification du trajet.');
            }
        }

        View::render('admin/trajets/edit', [
            'title'   => 'Modifier un trajet',
            'trajet'  => $trajet,
            'agences' => $agences,
        ]);
    }

    /**
     * Suppression d’un trajet (admin).
     *
     * @param int $id Identifiant du trajet.
     * @return void
     */
    public function delete(int $id): void
    {
        $user = Session::getUser();
        if (!$user || empty($user['est_admin'])) {
            Session::setFlash('danger', 'Accès réservé aux administrateurs.');
            header('Location: /');
            exit;
        }

        if ($id <= 0) {
            Session::setFlash('danger', 'Trajet invalide.');
            header('Location: /admin/trajets');
            exit;
        }

        if (Trajet::delete($id)) {
            Session::setFlash('success', 'Trajet supprimé avec succès.');
        } else {
            Session::setFlash('danger', 'Erreur lors de la suppression du trajet.');
        }

        header('Location: /admin/trajets');
        exit;
    }
}
