<?php
include_once('database.php');
$id = $_GET['id'];

$sql = "SELECT * FROM producten WHERE product_code = $id";
$stmt = $conn->query($sql);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$productNaam = $row['product_naam'];
$prijsPerStuk = $row['prijs_per_stuk'];
$omschrijving = $row['omschrijving'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
    <style>
        body {
            padding: 1rem;
        }
        form {
            width: 50%;
        }

        .btn {
            width: 100px;
        }

        form .form-control   {
            border: 1px solid gray;
        }
    </style>
</head>
<body>
    <h1>Data bijwerken</h1>

    <form action="" method="post">
        <label for="productNaam" style="font-size: 25px;">Product naam</label><br>
        <input class="form-control" type="text" name="productNaam" placeholder="<?php echo $productNaam?>"><br><br>
        <label for="prijsPerStuk" style="font-size: 25px;">Prijs per stuk</label><br>
        <input class="form-control" type="text" name="prijsPerStuk" placeholder="<?php echo $prijsPerStuk?>"><br><br>
        <label for="omschrijving" style="font-size: 25px;">Omschrijving</label><br>
        <input class="form-control" type="text" name="omschrijving" placeholder="Nieuwe omschrijving"><br><br>
        <input class="btn btn-primary" name="submit" type="submit" value="Bewerken">
    </form><br>

    <?php
    if (isset($_POST['submit'])) {
        $productNaam = $_POST['productNaam'];
        $prijsPerStuk = $_POST['prijsPerStuk'];
        $omschrijving = $_POST['omschrijving'];


        $sqlUpdate = 'UPDATE producten SET product_naam = :productNaam, prijs_per_stuk = :prijsPerStuk, omschrijving = :omschrijving WHERE product_code = :product_code';
        $stmt = $conn->prepare($sqlUpdate);

        $params = array (
            'productNaam' => $productNaam,
            'prijsPerStuk' => $prijsPerStuk,
            'omschrijving' => $omschrijving,
            'product_code' => $id
        );
        $stmt->execute($params);
        if ($stmt) {
            echo "<h1>Product succesvol bijgewerkt</h1>";
        } else {
            echo "<h1>Error</h1>";
        }
    }

    ?>
</body>
</html>