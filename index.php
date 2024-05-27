<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio de Jeu Vidéo Indépendant</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="jumbotron text-center">
            <h1>Bienvenue sur notre site <? ?></h1>
            <p>Ne prenez que le meilleur !</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <h2>Nos Jeux</h2>
                <p>Explorez notre collection de jeux vidéo.</p>
                <p><a class="btn btn-primary" href="games.php" role="button">Voir les jeux »</a></p>
            </div>
            <div class="col-md-4">
                <h2>Panier</h2>
                <p>Voir et gérer votre panier.</p>
                <p><a class="btn btn-primary" href="cart.php" role="button">Voir le panier »</a></p>
            </div>
            <div class="col-md-4">
                <h2>Contactez-nous</h2>
                <p>Avez-vous des questions? Contactez-nous!</p>
                <p><a class="btn btn-primary" href="contact.php" role="button">Contact »</a></p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
