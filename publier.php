<?php
// Inclure la connexion à la base de données
include 'base.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification des champs du formulaire
    $prenom = htmlspecialchars($_POST['prenom'] ?? '');
    $commentaire = htmlspecialchars($_POST['commentaire'] ?? '');
    $image = '';

    // Validation de l'image téléversée
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $dossierbank = 'bank/'; // Dossier pour stocker les images
        if (!is_dir($dossierbank)) {
            mkdir($dossierbank, 0755, true); // Création du dossier si inexistant
        }

        $fileName = basename($_FILES['image']['name']);
        $uploadFilePath = $dossierbank . $fileName;

        // Déplacement du fichier téléversé
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFilePath)) {
            $image = $uploadFilePath; // Chemin de l'image à enregistrer dans la base de données
        } else {
            echo "<div class='alert alert-danger'>Erreur lors du téléversement de l'image.</div>";
            exit;
        }
    } else {
        echo "<div class='alert alert-danger'>Veuillez sélectionner une image valide.</div>";
        exit;
    }

    // Requête SQL avec PDO
    $sql = "INSERT INTO publication (prenom, commentaire, image) VALUES (:prenom, :commentaire, :image)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        try {
            $stmt->execute([
                ':prenom' => $prenom,
                ':commentaire' => $commentaire,
                ':image' => $image,
            ]);
            // Redirection après succès
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
        }
    } else {
        die("Erreur lors de la préparation de la requête : " . print_r($conn->errorInfo(), true));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/publier.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <section>
    <!-- Affichage de la partie en haut si la personne veut faire une publication -->
    <div class="afficherpub">
        
        <!-- Formulaire pour publier un message -->
        <div class="publier">
        <div class="bonjour">
            <h2>Bonjour <?php echo htmlspecialchars($prenom ?? 'prenom'); ?></h2>
        </div>
            <form action="publier.php" method="post" enctype="multipart/form-data">
                <label for="prenom">Votre pseudo :</label>
                <input type="text" id="prenom" name="prenom" required /><br>

                <label for="commentaire">Commentaire :</label>
                <input type="text" id="commentaire" name="commentaire" required /><br>

                <label for="image">Charger votre image ici :</label>
                <input type="file" id="image" name="image" required /><br>

                <input type="submit" value="Publier" />
            </form>
        </div>
    </div>
    </section>
    <?php include 'footer.php'; ?>
</body>
</html>
