-Fichiers et Structures
*adresse.php: Gère la logique côté serveur pour le traitement de la recherche d'adresse, les requêtes API et l'affichage des résultats sur la carte.*

*index.php: Le fichier HTML principal qui inclut la carte Leaflet et le formulaire de recherche.*

*style.css: Contient les styles de base pour la mise en page de la page web.*

-Comment Utiliser;
*Clonez le dépôt sur votre machine locale.*
*Ouvrez xampp et tapez localhost/le nom de votre dossier*
*La carte s'affichera des marqueurs lorsque l'on va taper une adresse valide.*

-(adresse.php)
*Utilise PHP pour gérer les soumissions de formulaire via la méthode POST.*
*Construit l'URL de l'API en fonction de l'entrée utilisateur.*
*Utilise cURL pour effectuer des requêtes API.*
*Analyse la réponse de l'API, valide la conversion JSON et affiche les paires clé et valeur.*

-(index.php)
*Initialise la carte Leaflet avec une vue par défaut.*
*Utilise l'API Fetch pour effectuer des requêtes à l'API Adresse.*
*Supprime les couches GeoJSON existantes avant d'en ajouter une nouvelle pour éviter la duplication.*
*Affiche des marqueurs sur la carte avec des informations pour chaque adresse.*

-Style (style.css)
*Applique un style de base à la page web pour une présentation un minimum présentable.*
*Inclut un effet de dégradé en haut de la page pour faire jolie.*
