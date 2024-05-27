<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$cart = $_SESSION['cart'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT INTO orders (user_id) VALUES ('$user_id')";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;

        foreach ($cart as $game_id => $quantity) {
            $sql = "INSERT INTO order_items (order_id, game_id, quantity) VALUES ('$order_id', '$game_id', '$quantity')";
            $conn->query($sql);
        }

        $_SESSION['cart'] = array();

        echo "Commande passée avec succès !";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer à la caisse</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1 class="my-4">Passer à la caisse</h1>
        <form method="post" action="checkout.php">
            <button type="submit" class="btn btn-success">Confirmer la commande</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
