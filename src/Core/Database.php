<?php

namespace App\Core;

use PDO;
use PDOException;


/**
 * Classe responsable de la gestion de la connexion à la base de données.
 *
 * Implémente un pattern Singleton simple afin de réutiliser la même instance PDO.
 */

class Database
{
    /**
     * Instance PDO unique (singleton simple).
     *
     * @var PDO|null
     */
    private static ?PDO $pdo = null;

    /**
     * Retourne la connexion PDO.
     */
    public static function getConnection(): PDO
    {
        // Si déjà connectés, on renvoie la même instance
        if (self::$pdo instanceof PDO) {
            return self::$pdo;
        }

        /**
         * On charge le fichier de config qui retourne un tableau :
         * [
         *   'db_host' => 'localhost',
         *   'db_name' => 'touche_pas_au_klaxon',
         *   'db_user' => 'root',
         *   'db_pass' => ''
         * ]
         *
         * @var array<string,mixed> $config
         */
        $config = require __DIR__ . '/../../config/config.php';

        // On récupère les valeurs en s'assurant qu'elles sont toujours définies
        $dbHost = isset($config['db_host']) ? (string) $config['db_host'] : 'localhost';
        $dbName = isset($config['db_name']) ? (string) $config['db_name'] : '';
        $dbUser = isset($config['db_user']) ? (string) $config['db_user'] : '';
        $dbPass = isset($config['db_pass']) ? (string) $config['db_pass'] : '';

        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', $dbHost, $dbName);

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            self::$pdo = new PDO($dsn, $dbUser, $dbPass, $options);
        } catch (PDOException $e) {
            // En prod : logger puis message générique
            die('Erreur de connexion à la base de données.');
        }

        return self::$pdo;
    }
}
