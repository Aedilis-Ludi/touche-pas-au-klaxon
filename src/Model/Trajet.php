<?php

namespace App\Model;

use App\Core\Database;
use PDO;

/**
 * Modèle Trajet.
 * Gestion des trajets.
 */
class Trajet
{
    /**
     * Retourne tous les trajets avec informations complètes.
     * Utilisé pour l'administration.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getAll(): array
    {
        $pdo = Database::getConnection();

        $sql = "
            SELECT 
                t.*,
                u.nom        AS nom_contact,
                u.prenom     AS prenom_contact,
                u.telephone  AS tel_contact,
                u.email      AS email_contact,
                a1.nom_ville AS ville_depart,
                a2.nom_ville AS ville_arrivee
            FROM trajet t
            JOIN utilisateur u ON t.id_utilisateur = u.id_utilisateur
            JOIN agence a1 ON t.id_agence_depart = a1.id_agence
            JOIN agence a2 ON t.id_agence_arrivee = a2.id_agence
            ORDER BY t.date_heure_depart ASC
        ";

        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retourne la liste publique des trajets disponibles.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getPublicList(): array
    {
        $pdo = Database::getConnection();

        $sql = "
            SELECT 
                t.*,
                u.nom        AS nom_contact,
                u.prenom     AS prenom_contact,
                u.telephone  AS tel_contact,
                u.email      AS email_contact,
                a1.nom_ville AS ville_depart,
                a2.nom_ville AS ville_arrivee
            FROM trajet t
            JOIN utilisateur u ON t.id_utilisateur = u.id_utilisateur
            JOIN agence a1 ON t.id_agence_depart = a1.id_agence
            JOIN agence a2 ON t.id_agence_arrivee = a2.id_agence
            WHERE t.nb_places_disponibles > 0
            ORDER BY t.date_heure_depart ASC
        ";

        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retourne un trajet par identifiant.
     *
     * @param int $id
     * @return array<string, mixed>|null
     */
    public static function find(int $id): ?array
    {
        $pdo = Database::getConnection();
        $sql = "SELECT * FROM trajet WHERE id_trajet = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $trajet = $stmt->fetch(PDO::FETCH_ASSOC);

        return $trajet ?: null;
    }

    /**
     * Crée un nouveau trajet.
     *
     * @param array<string, mixed> $data
     * @return bool
     */
    public static function create(array $data): bool
    {
        $pdo = Database::getConnection();

        $sql = "
            INSERT INTO trajet (
                id_utilisateur,
                id_agence_depart,
                id_agence_arrivee,
                date_heure_depart,
                date_heure_arrivee,
                nb_places_total,
                nb_places_disponibles
            ) VALUES (
                :id_utilisateur,
                :id_agence_depart,
                :id_agence_arrivee,
                :date_heure_depart,
                :date_heure_arrivee,
                :nb_places_total,
                :nb_places_disponibles
            )
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'id_utilisateur'        => $data['id_utilisateur'],
            'id_agence_depart'      => $data['id_agence_depart'],
            'id_agence_arrivee'     => $data['id_agence_arrivee'],
            'date_heure_depart'     => $data['date_heure_depart'],
            'date_heure_arrivee'    => $data['date_heure_arrivee'],
            'nb_places_total'       => $data['nb_places_total'],
            'nb_places_disponibles' => $data['nb_places_disponibles'],
        ]);
    }

    /**
     * Met à jour un trajet existant.
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public static function update(int $id, array $data): bool
    {
        $pdo = Database::getConnection();

        $sql = "
            UPDATE trajet
            SET
                id_agence_depart      = :id_agence_depart,
                id_agence_arrivee     = :id_agence_arrivee,
                date_heure_depart     = :date_heure_depart,
                date_heure_arrivee    = :date_heure_arrivee,
                nb_places_total       = :nb_places_total,
                nb_places_disponibles = :nb_places_disponibles
            WHERE id_trajet = :id
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'id'                    => $id,
            'id_agence_depart'      => $data['id_agence_depart'],
            'id_agence_arrivee'     => $data['id_agence_arrivee'],
            'date_heure_depart'     => $data['date_heure_depart'],
            'date_heure_arrivee'    => $data['date_heure_arrivee'],
            'nb_places_total'       => $data['nb_places_total'],
            'nb_places_disponibles' => $data['nb_places_disponibles'],
        ]);
    }

    /**
     * Supprime un trajet.
     *
     * @param int $id
     * @return bool
     */
    public static function delete(int $id): bool
    {
        $pdo = Database::getConnection();
        $sql = "DELETE FROM trajet WHERE id_trajet = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }
}
