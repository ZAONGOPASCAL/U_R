<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/message.css">
    <link rel="stylesheet" href="style/publier.css">

</head>
<body>
    <!-- Inclusion du menu -->
    <?php include 'menu.php';?>
    <div class="message">
        <p>@<?php $user?></p>
        <h2>message</h2>
    </div>
    <!-- Inclusion du footer -->
    <?php include 'footer.php';?>
</body>
</html>