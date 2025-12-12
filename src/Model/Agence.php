<?php

namespace App\Model;

use App\Core\Database;
use PDO;

/**
 * Modèle Agence.
 * Gestion des agences (villes).
 */
class Agence
{
    /**
     * Retourne la liste complète des agences.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getAll(): array
    {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM agence ORDER BY nom_ville ASC";
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retourne une agence par son identifiant.
     *
     * @param int $id
     * @return array<string, mixed>|null
     */
    public static function find(int $id): ?array
    {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM agence WHERE id_agence = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $agence = $stmt->fetch(PDO::FETCH_ASSOC);
        return $agence ?: null;
    }

    /**
     * Crée une nouvelle agence.
     *
     * @param array<string, mixed> $data
     * @return bool
     */
    public static function create(array $data): bool
    {
        $pdo = Database::getConnection();

        $sql = "
            INSERT INTO agence (nom_ville)
            VALUES (:nom_ville)
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'nom_ville' => $data['nom_ville'],
        ]);
    }

    /**
     * Met à jour une agence existante.
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public static function update(int $id, array $data): bool
    {
        $pdo = Database::getConnection();

        $sql = "
            UPDATE agence
            SET nom_ville = :nom_ville
            WHERE id_agence = :id
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'id'        => $id,
            'nom_ville' => $data['nom_ville'],
        ]);
    }

    /**
     * Supprime une agence.
     *
     * @param int $id
     * @return bool
     */
    public static function delete(int $id): bool
    {
        $pdo = Database::getConnection();

        $sql = "DELETE FROM agence WHERE id_agence = :id";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }
}
