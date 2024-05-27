<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['order_id'])) {
    header("Location: order_history.php");
    exit();
}

$order_id = $_GET['order_id'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la commande</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1 class="my-4">Détails de la commande</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Jeu</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT g.name, g.price, oi.quantity FROM order_items oi 
                        JOIN games g ON oi.game_id = g.id 
                        WHERE oi.order_id = '$order_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($item = $result->fetch_assoc()) {
                        $total = $item['price'] * $item['quantity'];
                        echo "<tr>
                                <td>{$item['name']}</td>
                                <td>{$item['quantity']}</td>
                                <td>€{$total}</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Aucun article trouvé</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="order_history.php" class="btn btn-primary">Retour à l'historique des commandes</a>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>

<?php
$conn->close();
?>
