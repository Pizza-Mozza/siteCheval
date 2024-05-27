<?php
session_start();
include 'db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
    $id = $_GET['id'];
    if ($_GET['action'] == 'add') {
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = 1;
        } else {
            $_SESSION['cart'][$id]++;
        }
    } elseif ($_GET['action'] == 'remove') {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update') {
    foreach ($_POST['quantities'] as $id => $quantity) {
        $_SESSION['cart'][$id] = $quantity;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Panier</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1 class="my-4">Votre Panier</h1>
        <form method="post" action="cart.php">
            <input type="hidden" name="action" value="update">
            <table class="table">
                <thead>
                    <tr>
                        <th>Jeu</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $id => $quantity) {
                        $sql = "SELECT name, price FROM games WHERE id = $id";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $game = $result->fetch_assoc();
                            $subtotal = $game['price'] * $quantity;
                            $total += $subtotal;
                            echo "<tr>
                                    <td>{$game['name']}</td>
                                    <td><input type='number' name='quantities[{$id}]' value='{$quantity}' class='form-control' min='1'></td>
                                    <td>€{$game['price']}</td>
                                    <td>€{$subtotal}</td>
                                    <td><a href='cart.php?action=remove&id={$id}' class='btn btn-danger'>Supprimer</a></td>
                                </tr>";
                        }
                    }
                    ?>
                    <tr>
                        <td colspan="4">Total</td>
                        <td>€<?php echo $total; ?></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="checkout.php" class="btn btn-success">Passer à la caisse</a>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>

<?php
$conn->close();
?>
