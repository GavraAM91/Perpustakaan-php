<?php
session_start();
include 'connection.php';
$id_user = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style_order.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>MY ORDER</h1>
    <?php
    $query = "SELECT * FROM `order` WHERE name = '$id_user'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div class="card mb-3">
            <img src="image_data/<?= $row['image']; ?>">
            <div class="card-body">
                <h5 class="card-title">Book: <?php echo $row['book_name']; ?></h5>
                <p class="card-text">Random Code : <?php echo $row['random_code']; ?></p>
                <p class="card-text">Quantity : <?php echo $row['quantity']; ?></p>
            </div>
        </div>
    <?php } ?>

</body>

</html>