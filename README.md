# 🛍️ ShopEcommerce - Application E-commerce en PHP Natif

> **🔴 DÉMO EN LIGNE :** [Accéder au site hébergé](http://shopecommerce.alwaysdata.net)

Une application e-commerce complète développée en **PHP Natif (sans framework)**. 

Ce projet a pour but de démontrer ma maîtrise des fondamentaux du développement web backend et frontend :
*   **Sécurité** (Protection XSS, Injections SQL, Hachage de mots de passe).
*   **Gestion de base de données** relationnelle (MySQL).
*   **Déploiement** sur serveur distant (FTP/SQL).

L'interface utilisateur est conçue avec **Bootstrap 5** pour garantir une expérience responsive et moderne.

## 📸 Aperçu du projet

| Page d'accueil (Hero Section) | Détail Produit (UX/UI) |
|:---:|:---:|
| <img src="screens/accueil front.png" alt="Page Accueil" width="100%"> | <img src="screens/produit front.png" alt="Page Produit" width="100%"> |

**Tableau de bord Administrateur :**
<img src="screens/dashboard admin.png" alt="Admin Dashboard" width="100%">

## 🚀 Fonctionnalités Clés

### 👤 Partie Publique (Front-Office)
*   **Parcours Client :** Navigation par catégories, liste des produits avec filtres.
*   **Expérience Produit :** Page détail riche (Images, descriptions, produits similaires, calcul promo).
*   **Système de Panier :** Ajout dynamique, modification des quantités (Sessions PHP).
*   **Compte Client :** Inscription, connexion sécurisée et historique.

### 🔐 Partie Administration (Back-Office)
*   **Dashboard :** Statistiques en temps réel (Commandes à valider, Chiffre d'affaires, Stocks).
*   **Gestion du Catalogue :** CRUD complet (Ajouter/Modifier/Supprimer) pour Produits et Catégories.
*   **Upload d'images :** Gestion des fichiers médias sur le serveur.
*   **Gestion des Commandes :** Validation et suivi des statuts.

## 🛠️ Stack Technique

*   **Langage :** PHP 8.2 (Natif).
*   **Base de données :** MySQL.
*   **Front-end :** HTML5, CSS3, Bootstrap 5.
*   **Outils :** Git, FileZilla (FTP), Composer (optionnel).
*   **Hébergement :** Déployé sur **AlwaysData**.

## 💻 Installation (Pour tester en local)

Si vous souhaitez lancer le projet sur votre propre machine :

1.  **Cloner le dépôt :**
    ```bash
    git clone https://github.com/ABDELMAJID18990/ecommerce-website-avec-php-natif.git
    ```
2.  **Base de données :**
    *   Créez une base de données nommée `ecommerce_php` dans PHPMyAdmin.
    *   Importez le fichier `database.sql` (situé à la racine du projet).
3.  **Configuration :**
    *   Ouvrez `includes/database.php`.
    *   Modifiez les identifiants pour correspondre à votre serveur local (ex: `root` / pas de mot de passe).
4.  **Lancer le projet :**
    *   Accédez via `http://localhost/ShopEcommerce`.

## 👤 Auteur
**Abdelmajid Elainousi**  
[🌐 Mon Portfolio](https://elainousi-portfolio.vercel.app/) | [💼 Mon LinkedIn](https://linkedin.com/in/ton-profil)

---
*Projet réalisé pour démontrer des compétences Fullstack PHP.*
