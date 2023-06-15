<?php
include_once('database.php');
$id = $_GET['id'];

$sqlDelete = "DELETE FROM producten WHERE product_code = :id";
$stmt = $conn->prepare($sqlDelete);
$params = array(
    ':id' => $id
);
$stmt->execute($params);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../hotel_ter_duin/style/reset.css">
    <link rel="stylesheet" href="../hotel_ter_duin/style/reservering.css">
    <script src="https://kit.fontawesome.com/a46b3f773e.js" crossorigin="anonymous" defer></script>
    <title>Hotel Ter Duin - Reserveren</title>
</head>
<body>
    <main>
        <div class="container-bg">
            <h1>Product met ID <?php echo $id?> verwijderd</h1>
            <a href="index.php">Terug naar overzicht</a>
        </div>
    </main>
</body>
</html>