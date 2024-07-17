<?php include "service/connect.php";
session_start();
ob_start();
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
}
if (!isset($_SESSION['isLogin'])) {
    header("Location:
    login.php");
}
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        <?php include "css/style.css" ?>
    </style>
</head>

<body class="container">
    <center>
        <table border="0" class="text-center" id="title">
            <tr>
                <th class="display-4">Toko Merchant</th>
            </tr>
            <tr>
                <th class="display-6">Riwayat Transaksi</th>
            </tr>
            <tr>
                <th>
                    <hr style="border: 2px solid #f4eee0;">
                </th>
            </tr>
        </table>
    </center>
    <br>
    <h1 align="center">Riwayat Transaksi : <?=$_SESSION['email']?></h1>
    <br>
    <table border="1" class="table table-bordered" id="main">
        <tr>
            <th>No.</th>
            <th>ID Transaksi</th>
            <th>Email</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Jumlah Harga</th>
            <th>Tanggal</th>
        </tr>
        <?php
        $no = 1;
        $queryData = "select *from transaksi where email='$email'";
        $resultData = mysqli_query($db, $queryData);
        while ($row = mysqli_fetch_assoc($resultData)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['idTransaksi'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['idBarang'] ?></td>
                <td><?= $row['namaBarang'] ?></td>
                <td><?= $row['jumlahBarang'] ?></td>
                <td><?= $row['jumlahHarga'] ?></td>
                <td><?= $row['tanggal'] ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    </center>
</body>

</html>