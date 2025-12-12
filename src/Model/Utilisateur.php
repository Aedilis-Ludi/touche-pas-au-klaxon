<?php

namespace App\Model;

use App\Core\Database;
use PDO;

/**
 * Modèle Utilisateur.
 * Gestion des utilisateurs de l'application.
 */
class Utilisateur
{
    /**
     * Retourne la liste complète des utilisateurs.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getAll(): array
    {
        $pdo = Database::getConnection();
        $sql = "SELECT * FROM utilisateur ORDER BY id_utilisateur ASC";
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retourne un utilisateur par identifiant.
     *
     * @param int $id
     * @return array<string, mixed>|null
     */
    public static function find(int $id): ?array
    {
        $pdo = Database::getConnection();
        $sql = "SELECT * FROM utilisateur WHERE id_utilisateur = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    /**
     * Retourne un utilisateur à partir de son email.
     * Utilisé pour l’authentification.
     *
     * @param string $email
     * @return array<string, mixed>|null
     */
    public static function findByEmail(string $email): ?array
    {
        $pdo = Database::getConnection();
        $sql = "SELECT * FROM utilisateur WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    /**
     * Crée un nouvel utilisateur.
     *
     * @param array<string, mixed> $data
     * @return bool
     */
    public static function create(array $data): bool
    {
        $pdo = Database::getConnection();

        $sql = "
            INSERT INTO utilisateur (nom, prenom, telephone, email, mot_de_passe, est_admin)
            VALUES (:nom, :prenom, :telephone, :email, :mot_de_passe, :est_admin)
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'nom'          => $data['nom'],
            'prenom'       => $data['prenom'],
            'telephone'    => $data['telephone'],
            'email'        => $data['email'],
            'mot_de_passe' => $data['mot_de_passe'],
            'est_admin'    => $data['est_admin'] ?? 0,
        ]);
    }

    /**
     * Met à jour un utilisateur existant.
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public static function update(int $id, array $data): bool
    {
        $pdo = Database::getConnection();

        $sql = "
            UPDATE utilisateur
            SET
                nom = :nom,
                prenom = :prenom,
                telephone = :telephone,
                email = :email,
                mot_de_passe = :mot_de_passe,
                est_admin = :est_admin
            WHERE id_utilisateur = :id
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'id'           => $id,
            'nom'          => $data['nom'],
            'prenom'       => $data['prenom'],
            'telephone'    => $data['telephone'],
            'email'        => $data['email'],
            'mot_de_passe' => $data['mot_de_passe'],
            'est_admin'    => $data['est_admin'] ?? 0,
        ]);
    }

    /**
     * Supprime un utilisateur.
     *
     * @param int $id
     * @return bool
     */
    public static function delete(int $id): bool
    {
        $pdo = Database::getConnection();
        $sql = "DELETE FROM utilisateur WHERE id_utilisateur = :id";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }
}
