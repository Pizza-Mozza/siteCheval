<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirige vers une page de connexion
    exit();
}

$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des commandes</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1 class="my-4">Historique des commandes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Commande ID</th>
                    <th>Date</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($order = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$order['id']}</td>
                                <td>{$order['order_date']}</td>
                                <td><a href='order_details.php?order_id={$order['id']}' class='btn btn-info'>Voir les détails</a></td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Aucune commande trouvée</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>

<?php
$conn->close();
?>
