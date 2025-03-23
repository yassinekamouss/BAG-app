# AutoParts Hub - Plateforme de Vente de Pièces Automobiles

## 📌 Description
AutoParts Hub est une application web permettant aux clients de parcourir et d'acheter des pièces automobiles spécifiques à la marque Hyundai. L'application offre une expérience fluide avec un panier d'achat, un système de commande et un paiement sécurisé via Stripe. Un tableau de bord administrateur permet de gérer les produits, les commandes et les utilisateurs.

## 🚀 Technologies utilisées
- **Backend** : Laravel
- **Frontend** : Bootstrap, jQuery
- **Graphiques** : Chart.js
- **Paiement en ligne** : Stripe

## 📷 Capture d'écran
![Capture d'écran](https://github.com/yassinekamouss/BAG-app/blob/c7a07fb65624dcc39fae0fdac6eb71ecf6a92b35/Sans%20titre.png)

## 📂 Installation
### 1️⃣ Prérequis
- PHP (>= 8.0)
- Composer
- Node.js & npm
- MySQL

### 2️⃣ Cloner le projet
```bash
git clone https://github.com/votre-repo/autoparts-hub.git
cd autoparts-hub
```

### 3️⃣ Installer les dépendances
```bash
composer install
npm install && npm run dev
```

### 4️⃣ Configurer l'environnement
Copiez le fichier `.env.example` en `.env` et configurez la base de données ainsi que les clés Stripe.
```bash
cp .env.example .env
php artisan key:generate
```

### 5️⃣ Exécuter les migrations et seeders
```bash
php artisan migrate --seed
```

### 6️⃣ Lancer le serveur
```bash
php artisan serve
```
L'application sera accessible sur `http://127.0.0.1:8000`.

## 🛒 Fonctionnalités principales
- **Catalogue de pièces Hyundai**
- **Recherche et filtrage des produits**
- **Gestion du panier**
- **Paiement en ligne sécurisé avec Stripe**
- **Tableau de bord admin (gestion des commandes, utilisateurs, statistiques avec Chart.js)**

## ✨ Auteur
Développé par **Yassine Kamouss**.

## 📜 Licence
Ce projet est sous licence MIT.


# License

This Laravel project is open-sourced software
