<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Jeux</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1 class="my-4">Nos Jeux</h1>
        <div class="row">
            <?php
            $sql = "SELECT id, name, description, price, image FROM games";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='col-lg-4 col-md-6 mb-4'>
                            <div class='card h-100'>
                                <a href='#'><img class='card-img-top' src='img/{$row['image']}' alt='{$row['name']}'></a>
                                <div class='card-body'>
                                    <h4 class='card-title'><a href='#'>{$row['name']}</a></h4>
                                    <h5>€{$row['price']}</h5>
                                    <p class='card-text'>{$row['description']}</p>
                                </div>
                                <div class='card-footer'>
                                    <a href='cart.php?action=add&id={$row['id']}' class='btn btn-primary'>Ajouter au panier</a>
                                </div>
                            </div>
                        </div>";
                }
            } else {
                echo "0 résultats";
            }
            ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>

<?php
$conn->close();
?>
