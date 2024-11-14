# TP2-Bootcamp
Pour accéder au site du projet l'adresse est : http://localhost/tp2/pages/index.php
Pour accéder à une description plus approfondit du projet :
 
## Avant de commencer :
Pour améliorer ma procédure de test j'ai fait en sorte que lors de la création mais aussi si tout les contacts on étaient supprimer un contact nommé TEST est créer.
L'architecture : 
TP2
│
├── css                   # Dossier pour les fichiers CSS
│   ├── input.css
│   ├── output.css
│   └── style.css
│
├── includes              # Dossier pour les fichiers PHP réutilisables et la logique
│   ├── db.php
│   ├── footer.php
│   ├── header.php
│   └── logique.php       # Fichier pour les opérations de suppression et autres logiques partagées
│
├── pages                 # Dossier pour les pages principales
│   ├── add_contact.php
│   ├── contact.php
│   ├── edit_contact.php
│   └── index.php
│
├── .gitignore
├── package-lock.json
├── package.json
├── readme.md
└── tailwind.config.js


## Explication des boutons :
* Ajouter un contact : **add_contact.php** permet d'ajouter un nouveau contact après avoir vérifié les informations.
* Modifier un contact : **edit_contact.php** permet de mettre à jour un contact existant après validation des nouvelles données.
* Supprimer un contact : **delete.php** permet de supprimer un contact spécifique via son ID.
