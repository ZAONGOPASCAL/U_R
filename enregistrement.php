<?php
try {
    // Connexion à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=AUBEN;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activer les erreurs PDO
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

if (!empty($_POST['prenom']) && !empty($_POST['commentaire'])) {
    // Insertion des données avec des requêtes préparées (plus sécurisé)
    $requete = $bdd->prepare(query: 'INSERT INTO publication (image, prenom, commentaire) VALUES (:image, :prenom, :commentaire)');
    $requete->execute([
        'prenom' => htmlspecialchars($_POST['prenom']), // Éviter les injections XSS
        'commentaire' => htmlspecialchars($_POST['commentaire']),
        'image' => htmlspecialchars($_POST['image'])
    ]);

    echo '<p> Données ajoutées avec succès !</p>';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si le formulaire a été soumis
        echo '<p>Veuillez remplir tous les champs.</p>';
    }
}
?>
