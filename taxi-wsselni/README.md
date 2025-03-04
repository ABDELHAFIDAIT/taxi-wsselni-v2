# Taxi Wsselni - Plateforme de Réservation de Grands Taxis

## 📌 Description du Projet
Taxi Wsselni est une plateforme intuitive permettant aux passagers de réserver facilement des grands taxis pour des trajets interurbains, et aux chauffeurs de gérer leurs trajets et disponibilités en toute simplicité. Ce projet est développé avec le framework **Laravel**.

## 🚀 Fonctionnalités Principales
### 🔹 Authentification et Gestion des Comptes
- Création de compte pour les passagers et chauffeurs avec photo de profil obligatoire.
- Connexion sécurisée avec identifiants.
- Gestion du profil utilisateur.

### 🔹 Réservation et Gestion des Trajets
- Réservation d'un taxi avec date, lieu de prise en charge et destination.
- Consultation de l'historique des trajets (réservations pour les passagers, courses effectuées pour les chauffeurs).
- Annulation de réservation avant l'heure de départ.
- Filtrage des chauffeurs par localisation et disponibilité.
- Acceptation ou refus des réservations par les chauffeurs.
- Mise à jour des disponibilités des chauffeurs (avec possibilité d'automatisation).

## 📌 Critères de Performance et Bonnes Pratiques
### 🔹 Implémentation des Bonnes Pratiques pour CRUD en Laravel
- Utilisation des **migrations** pour définir la structure de la base de données.
- Application du **modèle MVC** pour une meilleure séparation des préoccupations.
- Optimisation des requêtes avec **Eloquent ORM**.

### 🔹 Validation et Sécurité
- Validation stricte des données avec **Laravel Form Requests**.
- Utilisation de **Middleware** pour la validation et la sécurité.
- Gestion des erreurs et redirections pour une meilleure expérience utilisateur.

### 🔹 Gestion et Optimisation de la Base de Données
- **Seeders et Factories** pour générer des données de test réalistes.
- **Optimisation des requêtes Eloquent** pour éviter les surcharges.
- **Gestion des relations Eloquent** pour un chargement optimal des données.
- **Utilisation des Soft Deletes** pour conserver les données supprimées.

### 🔹 Optimisation des Performances
- Mise en place de **cache** pour réduire la charge sur la base de données.
- Tests de performance pour évaluer l’efficacité des requêtes et de l’application.
- Optimisation des **vues Blade** pour améliorer l’affichage et l’expérience utilisateur.

## ⚙️ Technologies Utilisées
- **Laravel** (Framework PHP)
- **PostgreSQL** (Base de données relationnelle)
- **Tailwind CSS** (Stylisation)
- **JavaScript** (Interactivité)

## 🛠 Installation et Configuration
### 1️⃣ Cloner le projet
```bash
git clone https://github.com/ABDELHAFIDAIT/taxi-wsselni.git
cd taxi-wsselni/taxi-wsselni
```

### 2️⃣ Installer les dépendances
```bash
composer install
npm install
```

### 3️⃣ Configurer l’environnement
Copier le fichier `.env.example` en `.env` et configurer la base de données :
```bash
cp .env.example .env
php artisan key:generate
```

### 4️⃣ Configurer la base de données
Créer la base de données et exécuter les migrations :
```bash
php artisan migrate --seed
```

### 5️⃣ Lancer le serveur
```bash
php artisan serve
```
L'application sera accessible sur **http://127.0.0.1:8000** 🚖

## 📜 Licence
Ce projet est sous licence MIT. Vous êtes libre de l'utiliser et de le modifier selon vos besoins.

## 📧 Contact
Pour toute question ou suggestion, n’hésitez pas à me contacter ! 🚀

