<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Session;
use App\Model\Agence;

/**
 * Contrôleur des agences.
 * Réservé aux administrateurs.
 */
class AgenceController
{
    /**
     * Vérifie que l'utilisateur connecté est administrateur.
     * Redirige sinon.
     *
     * @return array<string, mixed>
     */
    private function ensureAdmin(): array
    {
        $user = Session::getUser();

        if (!$user || empty($user['est_admin'])) {
            Session::setFlash('danger', 'Accès réservé aux administrateurs.');
            header('Location: /');
            exit;
        }

        return $user;
    }

    /**
     * Affiche la liste des agences.
     *
     * @return void
     */
    public function index(): void
    {
        $this->ensureAdmin();

        $agences = Agence::getAll();

        View::render('admin/agences/index', [
            'title'   => 'Gestion des agences',
            'agences' => $agences,
        ]);
    }

    /**
     * Création d'une agence.
     * Affichage du formulaire et traitement.
     *
     * @return void
     */
    public function create(): void
    {
        $this->ensureAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomVille = trim($_POST['nom_ville'] ?? '');

            if ($nomVille === '') {
                Session::setFlash('danger', 'Le nom de la ville est obligatoire.');
            } else {
                if (Agence::create(['nom_ville' => $nomVille])) {
                    Session::setFlash('success', 'Agence créée avec succès.');
                    header('Location: /admin/agences');
                    exit;
                }

                Session::setFlash('danger', 'Erreur lors de la création de l’agence.');
            }
        }

        View::render('admin/agences/create', [
            'title' => 'Créer une agence',
        ]);
    }

    /**
     * Modification d'une agence existante.
     *
     * @param int $id
     * @return void
     */
    public function edit(int $id): void
    {
        $this->ensureAdmin();

        if ($id <= 0) {
            Session::setFlash('danger', 'Agence invalide.');
            header('Location: /admin/agences');
            exit;
        }

        $agence = Agence::find($id);

        if (!$agence) {
            Session::setFlash('danger', 'Agence introuvable.');
            header('Location: /admin/agences');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomVille = trim($_POST['nom_ville'] ?? '');

            if ($nomVille === '') {
                Session::setFlash('danger', 'Le nom de la ville est obligatoire.');
            } else {
                if (Agence::update($id, ['nom_ville' => $nomVille])) {
                    Session::setFlash('success', 'Agence modifiée avec succès.');
                    header('Location: /admin/agences');
                    exit;
                }

                Session::setFlash('danger', 'Erreur lors de la modification de l’agence.');
            }
        }

        View::render('admin/agences/edit', [
            'title'  => 'Modifier une agence',
            'agence' => $agence,
        ]);
    }

    /**
     * Suppression d'une agence.
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->ensureAdmin();

        if ($id <= 0) {
            Session::setFlash('danger', 'Agence invalide.');
            header('Location: /admin/agences');
            exit;
        }

        if (Agence::delete($id)) {
            Session::setFlash('success', 'Agence supprimée avec succès.');
        } else {
            Session::setFlash('danger', 'Erreur lors de la suppression de l’agence.');
        }

        header('Location: /admin/agences');
        exit;
    }
}
