# 🧩 WoodyCraft

**WoodyCraft** est une application e-commerce complète développée avec **Laravel**, permettant la vente de puzzles en bois artisanaux.  
Le site propose un parcours utilisateur complet : navigation dans les catégories, ajout au panier, validation de commande, paiement, génération de facture PDF et système d’avis client.

---

## 🚀 Fonctionnalités principales

### 🏠 Page d’accueil
- Présentation des produits et catégories (Animaux, Architecture, Véhicules, etc.)
- Interface épurée et responsive avec **TailwindCSS**
- Navigation fluide et intuitive

### 🛍️ Gestion du panier
- Ajout, modification et suppression d’articles
- Calcul automatique du sous-total et du total
- Vérification du stock avant validation
- Sauvegarde du panier liée à l’utilisateur connecté

### 🧾 Gestion des commandes
- Création d’une commande complète :
  - Liste des produits
  - Adresses de facturation et de livraison
  - Méthode de paiement (ex. : chèque)
- Génération automatique d’une **facture PDF téléchargeable**
- Page de confirmation “Merci pour votre commande”

### ⭐ Gestion des avis clients
- Chaque client peut laisser **un seul avis** par commande
- Enregistrement de la **note (sur 5)** et d’un commentaire optionnel
- Affichage direct de l’avis sur la page commande
- Prévention des doublons (un avis par utilisateur et par commande)

### 👤 Authentification
- Gestion des utilisateurs via **Laravel Breeze / Jetstream**
- Accès restreint aux fonctionnalités (commandes, avis, etc.)
- Affichage personnalisé selon le profil connecté

---

## 🧠 Structure du projet

```
app/
 ├── Http/
 │    ├── Controllers/
 │    │    ├── HomeController.php
 │    │    ├── PanierController.php
 │    │    ├── CommandeController.php
 │    │    ├── AvisController.php
 │    │
 │    └── Middleware/
 │         └── EnsureUserHasAddress.php
 │
 ├── Models/
 │    ├── Puzzle.php
 │    ├── Commande.php
 │    ├── LigneCommande.php
 │    ├── Adresse.php
 │    └── Avis.php
 │
 └── Policies/
      └── CommandePolicy.php

resources/
 ├── views/
 │    ├── home/                  → Page d’accueil
 │    ├── categories/            → Affichage par catégorie
 │    ├── panier/                → Gestion du panier
 │    ├── commandes/             → Commandes & factures
 │    ├── avis/                  → Ajout / affichage des avis
 │    └── layouts/               → Structure globale (app.blade.php)
 │
routes/
 ├── web.php                     → Définition des routes principales
 │
database/
 ├── migrations/
 │    ├── create_commandes_table.php
 │    ├── create_lignes_commandes_table.php
 │    ├── create_avis_table.php
 │    └── autres migrations...
```

---

## 🗃️ Base de données principale

### Table `puzzles`
| Colonne | Type | Description |
|----------|------|-------------|
| id | int | Identifiant |
| nom | string | Nom du puzzle |
| prix | decimal | Prix unitaire |
| categorie_id | int | Catégorie du puzzle |

### Table `commandes`
| Colonne | Type | Description |
|----------|------|-------------|
| id | int | Identifiant |
| user_id | int | Utilisateur associé |
| montant_total | decimal | Total de la commande |
| mode_paiement | string | Mode de paiement |
| created_at | datetime | Date de commande |

### Table `avis`
| Colonne | Type | Description |
|----------|------|-------------|
| id | int | Identifiant |
| user_id | int | Auteur de l’avis |
| commande_id | int | Commande concernée |
| note | tinyint | Note sur 5 |
| commentaire | text | Commentaire optionnel |

---

## ⚙️ Installation du projet

### 1️⃣ Cloner le dépôt
```bash
git clone https://github.com/Fares685/woodycraft.git
cd woodycraft
```

### 2️⃣ Installer les dépendances
```bash
composer install
npm install
```

### 3️⃣ Configurer l’environnement
Crée ton fichier `.env` :
```bash
cp .env.example .env
```
Puis configure :
- Base de données MySQL (via Laragon)
- Nom du projet (`APP_NAME=WoodyCraft`)
- Autres variables Laravel

### 4️⃣ Générer la clé d’application
```bash
php artisan key:generate
```

### 5️⃣ Exécuter les migrations et les seeders
```bash
php artisan migrate --seed
```

### 6️⃣ Lancer le serveur local
```bash
php artisan serve
```

👉 Accède ensuite à **http://localhost:8000**

---

## 📦 Technologies utilisées

| Outil | Utilisation |
|--------|--------------|
| **Laravel 11** | Framework backend principal |
| **Blade + TailwindCSS** | Front-end responsive |
| **MySQL** | Base de données |
| **Laravel DOMPDF** | Génération de factures PDF |
| **Git / GitHub** | Versionning et collaboration |
| **Laragon** | Environnement local de développement |

---

## 🧑‍💻 Commandes Git utilisées

```bash
# Ajouter les fichiers
git add .

# Commit des modifications
git commit -m "Ajout du système d'avis + corrections panier/commande"

# Pousser sur une branche de feature
git push origin feat/panier-commande

# Fusion dans main via pull request
git checkout main
git pull origin main
git merge feat/panier-commande
git push origin main
```

---

## 💡 Auteur

👤 **SAIF Fares**  
Projet réalisé dans le cadre du **BTS SIO (SLAM)**.  
Objectif : concevoir une application e-commerce complète avec Laravel, incluant la gestion du panier, des commandes, des factures et des avis clients.

---

## 🧾 Licence

Ce projet est open-source et distribué sous licence **MIT**.
