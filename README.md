# 🚗 Touche pas au klaxon

Application web développée en **PHP** selon une **architecture MVC**, permettant la gestion et la consultation de trajets entre agences, avec authentification utilisateur et interface administrateur.

Projet réalisé dans le cadre d’un devoir de formation.

---

## 📌 Fonctionnalités

### 🔓 Utilisateur non connecté
- Consultation des trajets disponibles
- Affichage des informations de départ / arrivée
- Visualisation des places disponibles

### 👤 Utilisateur connecté
- Connexion / déconnexion
- Création de trajets
- Modification de ses propres trajets

### 🛠️ Administrateur
- Accès à un tableau de bord d’administration
- Gestion des agences (CRUD)
- Gestion de tous les trajets
- Consultation de la liste des utilisateurs (lecture seule)

---

## 🧱 Architecture du projet

Le projet suit une architecture **MVC (Model – View – Controller)** :

src/
├── Controller/ → Logique applicative
├── Core/ → Classes centrales (Database, View, Session)
├── Model/ → Accès aux données
├── View/ → Vues HTML / PHP
public/
└── index.php → Point d’entrée de l’application


---

## 🎨 Interface graphique

- **Bootstrap 5**
- **Sass**
- Palette de couleurs imposée et centralisée via variables
- Compilation Sass automatisée

---

## 🛢️ Base de données

- **MySQL / MariaDB**
- Schéma fourni dans le fichier `database.sql`
- Tables principales :
  - `utilisateur`
  - `agence`
  - `trajet`

---

## ⚙️ Prérequis

- PHP **≥ 7.4**
- MySQL ou MariaDB
- Composer
- Node.js & npm
- Serveur local (PHP intégré, XAMPP, WAMP, Laragon, etc.)

---

## 🚀 Installation

## 1.Cloner le dépôt
```bash
git clone https://github.com/Aedilis-Ludi/touche-pas-au-klaxon.git
cd touche-pas-au-klaxon


## 2. Installation des dépendances PHP

Ce projet utilise Composer pour la gestion des dépendances PHP.

Depuis la racine du projet, exécuter la commande suivante :

```bash
composer install



```md
## 3. Installation des dépendances front-end

Le projet utilise Sass et Bootstrap pour la gestion des styles.

Installer les dépendances front-end avec la commande suivante :

```bash
npm install



---

```md
## 4. Compilation des fichiers Sass

Les styles de l’application sont écrits en Sass et doivent être compilés en CSS.

Pour compiler les fichiers Sass une fois :

```bash
npm run build:css


npm run watch:css



---

```md
## 5. Importation de la base de données

La structure de la base de données est fournie dans le fichier `database.sql`.

Procédure :
1. Ouvrir phpMyAdmin
2. Créer une base de données (par exemple : `touche_pas_au_klaxon`)
3. Sélectionner la base de données créée
4. Importer le fichier `database.sql`

La base de données est maintenant prête à être utilisée par l’application.


## 6. Configuration de la connexion à la base de données

La configuration de la base de données se fait dans le fichier :


Exemple de configuration :

```php
return [
    'db_host' => 'localhost',
    'db_name' => 'touche_pas_au_klaxon',
    'db_user' => 'root',
    'db_pass' => '',
];



---

```md
## Lancer l’application en local

L’application peut être lancée à l’aide du serveur PHP intégré.

Depuis la racine du projet, exécuter la commande suivante :

```bash
php -S localhost:4000 -t public

http://localhost:4000


