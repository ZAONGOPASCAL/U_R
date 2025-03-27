<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
    <link rel="stylesheet" href="style/styleconnection.css">
</head>
<body>
    <form action="index.php" method="post">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">

        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" placeholder="Entrez votre mot de passe">
        
        <input type="submit" value="Se connecter">
        <a href="inscription.php">S'inscrire</a>
    </form>
</body>
</html>