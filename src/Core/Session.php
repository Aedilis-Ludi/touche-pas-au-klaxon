<?php

namespace App\Core;

/**
 * Gestion simplifiée des sessions, messages flash et utilisateur connecté.
 */
class Session
{
    /**
     * Démarre la session si nécessaire.
     */
    private static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // --- GET & SET classiques ---

    /**
     * Récupère une valeur en session.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Enregistre une valeur en session.
     *
     * @param string $key
     * @param mixed $value
     */
    public static function set(string $key, $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Supprime une entrée de session.
     *
     * @param string $key
     */
    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    /**
     * Détruit complètement la session.
     */
    public static function destroy(): void
    {
        self::start();
        $_SESSION = [];
        session_destroy();
    }

    // --- MESSAGES FLASH ---

    /**
     * Enregistre un message flash.
     *
     * @param string $type
     * @param string $message
     */
    public static function setFlash(string $type, string $message): void
    {
        self::start();
        $_SESSION['flash'] = [
            'type'    => $type,
            'message' => $message,
        ];
    }

    /**
     * Récupère puis supprime le message flash.
     *
     * @return array|null
     */
    public static function getFlash(): ?array
    {
        self::start();
        if (!isset($_SESSION['flash'])) {
            return null;
        }

        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    // --- GESTION AUTOMATIQUE DE L’UTILISATEUR CONNECTÉ ---

    /**
     * Stocke l'utilisateur actuellement connecté.
     *
     * @param array $user
     */
    public static function setUser(array $user): void
    {
        self::set('user', $user);
    }

    /**
     * Retourne l'utilisateur connecté ou null.
     *
     * @return array|null
     */
    public static function getUser(): ?array
    {
        $user = self::get('user');
        return $user ?: null;
    }
}
