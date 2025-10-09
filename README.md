# 🧩 WoodyCraft

WoodyCraft est une application e-commerce Laravel permettant aux utilisateurs d’acheter des puzzles en bois artisanaux.  
Ce projet inclut la gestion du panier, du passage de commande, la génération de facture PDF et un système d’avis client complet.

---

## 🚀 Fonctionnalités principales

### 🛒 Gestion du panier
- Ajout, suppression et modification de produits dans le panier  
- Calcul automatique du **montant total**  
- Vérification du stock avant la validation  

### 🧾 Gestion des commandes
- Enregistrement complet d’une commande avec :
  - Détails des articles commandés
  - Adresse de livraison et de facturation
  - Mode de paiement (chèque, paypal, etc.)
- Génération automatique d’une **facture PDF** téléchargeable  
- Redirection sur le site **paypal** 
- Page de confirmation de commande (“Merci pour votre commande”)

### 🌟 Système d’avis clients
- Chaque utilisateur peut **laisser un avis** sur sa commande après réception  
- Un seul avis est autorisé par commande (prévention des doublons)
- Affichage de la **note sur 5** et du commentaire sur la page commande  
- Enregistrement en base dans la table `avis` liée à la commande et à l’utilisateur

### 👤 Authentification
- Accès sécurisé grâce à **Laravel Breeze / Jetstream**
- L’utilisateur doit être connecté pour consulter ou créer un avis

### 🧠 Interface claire
- Design sobre et responsive grâce à **TailwindCSS**
- Pages :
  - `Accueil` — présentation des produits
  - `Catégories` — navigation par type de puzzle
  - `Panier` — résumé et validation
  - `Commandes` — historique et détail
  - `Avis` — ajout / affichage d’un avis client

---

## ⚙️ Structure du projet

```
app/
 ├── Http/
 │    ├── Controllers/
 │    │    ├── CommandeController.php
 │    │    ├── PanierController.php
 │    │    ├── AvisController.php   ← Gestion des avis clients
 │    │
 │    └── Middleware/
 │         └── EnsureUserHasAddress.php
 │
 ├── Models/
 │    ├── Commande.php              ← Relation avec Avis et Lignes de commande
 │    ├── Avis.php                  ← Note + Commentaire + User + Commande
 │    ├── Puzzle.php
 │    ├── LigneCommande.php
 │
 └── Policies/
      └── CommandePolicy.php        ← Protection d’accès par utilisateur

resources/
 ├── views/
 │    ├── commandes/
 │    │     ├── show.blade.php     ← Détail d’une commande + bloc d’avis
 │    │     ├── facture.blade.php  ← Génération PDF
 │    │     └── merci.blade.php
 │    ├── avis/
 │    │     └── create.blade.php   ← Formulaire de création d’avis
 │    └── layouts/
 │          └── app.blade.php
 │
routes/
 ├── web.php                        ← Routes principales (commandes, avis, panier)
 │
database/
 ├── migrations/
 │     └── 2025_10_09_145854_create_avis_table.php ← Table des avis
```

---

## 🗃️ Base de données

### Table `avis`
| Colonne        | Type        | Description                              |
|----------------|-------------|------------------------------------------|
| id             | int         | Identifiant unique                      |
| user_id        | int         | Utilisateur ayant laissé l’avis         |
| commande_id    | int         | Commande associée                       |
| note           | tinyint     | Note sur 5                              |
| commentaire    | text (null) | Avis facultatif                         |
| created_at     | datetime    | Date de création                        |
| updated_at     | datetime    | Dernière mise à jour                    |

---

## 🧑‍💻 Déploiement GitHub

- Branche principale : `main`  
- Branche de développement : `feat/panier-commande`  
- Pull Request effectuée pour fusionner les modifications sur `main`  
- Authentification via GitHub CLI (`gh auth login`)  
- Commandes Git utilisées :
  ```bash
  git add .
  git commit -m "Ajout du système d'avis + corrections panier/commande"
  git push origin feat/panier-commande
  ```

---

## 📦 Technologies utilisées

- **Laravel 11**
- **Blade / TailwindCSS**
- **MySQL**
- **Laravel DOMPDF** (factures PDF)
- **Git / GitHub**
- **Laragon** (serveur local)

---

## 🧑‍🔧 Auteur

**SAIF Fares**  
Projet réalisé dans le cadre du BTS SIO — Développement d’un site e-commerce Laravel complet avec gestion d’avis client.
