# Taxi Wsselni - Plateforme de Réservation de Grands Taxis

## 📌 Description du Projet
Taxi Wsselni est une plateforme intuitive permettant aux passagers de réserver facilement des grands taxis pour des trajets interurbains, et aux chauffeurs de gérer leurs trajets et disponibilités en toute simplicité. Ce projet est développé avec le framework **Laravel**.

## 🚀 Fonctionnalités Principales
### 🔹 Authentification et Gestion des Comptes
- Création de compte pour les passagers et chauffeurs avec photo de profil obligatoire.
- Connexion sécurisée avec identifiants.
- Connexion via **Google et Facebook** grâce à **Laravel Socialite**.
- Gestion du profil utilisateur.

### 🔹 Réservation et Gestion des Trajets
- Réservation d'un taxi avec date, lieu de prise en charge et destination.
- Consultation de l'historique des trajets (réservations pour les passagers, courses effectuées pour les chauffeurs).
- Annulation de réservation avant l'heure de départ.
- Filtrage des chauffeurs par localisation et disponibilité.
- Acceptation ou refus des réservations par les chauffeurs.
- Mise à jour automatique des disponibilités des chauffeurs en fonction de leurs trajets en cours et à venir.

### 🔹 Gestion Administrative
- Un **tableau de bord pour les administrateurs** permettant de gérer les utilisateurs (chauffeurs et passagers).
- Gestion et suivi des trajets avec des **statistiques détaillées** (nombre de trajets effectués, trajets annulés, revenus générés, etc.).
- Outil de supervision des réservations et des disponibilités des chauffeurs.

### 🔹 Avis et évaluations
- Les passagers peuvent **laisser une note et un commentaire** après un trajet pour évaluer leur expérience avec le chauffeur.
- Les chauffeurs peuvent également **noter et commenter les passagers** en fonction de leur comportement.
- Affichage des avis sur les profils des utilisateurs pour une **meilleure transparence**.

### 🔹 Paiement Sécurisé
- Intégration du **paiement en ligne via Stripe** pour permettre aux passagers de régler leurs trajets directement sur la plateforme.

### 🔹 Notifications et Gestion des Réservations
- Envoi d’un **email au passager** lors de l’acceptation de sa réservation, contenant un **QR Code** avec les informations de la demande.
- Amélioration des **notifications en temps réel** pour informer les utilisateurs des mises à jour concernant leurs réservations.

## 📌 Critères de Performance et Bonnes Pratiques
### 🔹 Implémentation des Bonnes Pratiques pour CRUD en Laravel
- Utilisation des **migrations** pour définir la structure de la base de données.
- Application du **modèle MVC** pour une meilleure séparation des préoccupations.
- Optimisation des requêtes avec **Eloquent ORM**.

### 🔹 Validation et Sécurité
- Validation stricte des données avec **Laravel Form Requests**.
- Utilisation de **Middleware** pour la validation et la sécurité.
- Gestion des erreurs et redirections pour une meilleure expérience utilisateur.
- Assurer la sécurité et l'intégrité des données en appliquant des **règles de validation strictes**.
- Génération de **slug** pour des **URLs conviviales et optimisées pour le référencement**.
- Intégration de **messages flash** pour des interactions utilisateur plus conviviales.

### 🔹 Gestion et Optimisation de la Base de Données
- **Utilisation de PostgreSQL** comme base de données principale pour une robustesse et une évolutivité optimales.
- **Seeders et Factories** pour générer des données de test réalistes.
- **Optimisation des requêtes Eloquent** pour éviter les surcharges.
- **Gestion des relations Eloquent** pour un chargement optimal des données.
- **Utilisation des Soft Deletes** pour conserver les données supprimées.

### 🔹 Optimisation des Performances
- **Implémentation de la mise en cache** pour améliorer les performances et réduire les temps de chargement.
- Tests de performance pour évaluer l’efficacité des requêtes et de l’application.
- Optimisation des **vues Blade** pour améliorer l’affichage et l’expérience utilisateur.

## ⚙️ Technologies Utilisées
- **Laravel** (Framework PHP)
- **PostgreSQL** (Base de données relationnelle)
- **Tailwind CSS** (Stylisation)
- **JavaScript** (Interactivité)
- **Stripe** (Paiement en ligne)
- **Laravel Socialite** (Authentification via Google et Facebook)

## 🛠 Installation et Configuration
### 1️⃣ Cloner le projet
```bash
git clone https://github.com/ABDELHAFIDAIT/taxi-wsselni-v2.git
cd taxi-wsselni-v2/taxi-wsselni
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