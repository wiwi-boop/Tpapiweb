<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // c'est pour etre sur que le 'userinput' exsite bien
    if (isset($_POST['userInput'])) {
        $userInput = $_POST['userInput'];

        // contruction de l'url
        $apiUrl = 'https://api-adresse.data.gouv.fr/search/?q=' . urlencode($userInput);

        // Utilisez cURL pour effectuer la requête à l'API (meilleure gestion des erreurs que file_get_contents)
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $apiResponse = curl_exec($ch);
        curl_close($ch);

        // verification de l'API si elle es validé
        if ($apiResponse !== false) {
            // decoder la reponse json
            $apiData = json_decode($apiResponse, true);
            if ($apiData !== null) {
                // parcourir le tableau
                foreach ($apiData as $key => $value) {
                    // on peut faire quelque chose avec chaque paire clé et valeur 
                    echo "Clé: $key, Valeur: $value <br>";
                }
            } else {
                // gerer au cas la requete en json n'a pas fonctionné
                echo "Erreur lors de la conversion JSON";
            }

            // Redirigez ensuite vers index.php
           // header("Location: index.php");
           //
            exit();
        } else {
            // pour gérer l'erreur dans l'API
            echo "Erreur lors de la requête API";
        }
    } else {
        // c'est pour gérer le cas où 'userInput' est pas défini dans le formulaire post
        echo "Le champ 'userInput' n'est pas défini dans le formulaire POST";
    }
}
?>
