<?php
include_once('database.php');

$query = "SELECT * FROM producten";
$stmt = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous" defer></script>
    <title>Document</title>
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
<h1>Data Toevoegen</h1>
    <form action="" method="post">
        <label for="productNaam" style="font-size: 25px;">Product naam</label><br>
        <input class="form-control" type="text" name="productNaam"><br><br>
        <label for="prijsPerStuk" style="font-size: 25px;">Prijs per stuk</label><br>
        <input class="form-control" type="text" name="prijsPerStuk"><br><br>
        <label for="omschrijving" style="font-size: 25px;">Omschrijving</label><br>
        <input class="form-control" type="text" name="omschrijving"><br><br>
        <input class="btn btn-primary" name="submit" type="submit" value="Toevoegen">
    </form><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Naam</th>
                <th scope="col">Prijs</th>
                <th scope="col">Omschrijving</th>
                <th scope="col">Bewerken</th>
                <th scope="col">Verwijderen</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row['product_naam']."</td>";
                echo "<td>".$row['prijs_per_stuk']."</td>";
                echo "<td>".$row['omschrijving']."</td>";
                echo "<td><a href='update.php?id=" . $row['product_code'] . "'>Bewerken</a></td>";
                echo "<td><a href='delete.php?id=" . $row['product_code'] . "'>Verwijderen</a></td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
    <?php
    if (isset($_POST['submit'])) {
        $productNaam = $_POST['productNaam'];
        $prijsPerStuk = $_POST['prijsPerStuk'];
        $omschrijving = $_POST['omschrijving'];


        $sqlInsert = 'INSERT INTO producten(product_naam, prijs_per_stuk, omschrijving) VALUES (:productNaam, :prijsPerStuk, :omschrijving)';
        $stmt = $conn->prepare($sqlInsert);

        $params = array(
            'productNaam' => $productNaam,
            'prijsPerStuk' => $prijsPerStuk,
            'omschrijving' => $omschrijving
        );
        $stmt->execute($params);

        if ($stmt) {
            echo "<h1 style='text-align:center;font-size:25px'> $productNaam succesvol toegevoegd in de database</h1>";
        } else {
            echo "<h1 style='text-align:center;font-size:25px'>Error</h1>";
        }
    }
    ?>
</body>
</html>