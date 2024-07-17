<?php 
include "service/connect.php";
session_start();
ob_start();
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
    <title>Keranjang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    </style>
</head>

<body class="container">
    <center>
        <table border="0" class="text-center" id="title">
            <tr>
                <th class="display-4">Toko Fragrance</th>
            </tr>
            <tr>
                <th class="display-6">Keranjang Belanja</th>
            </tr>
            <tr>
                <th>
                    <hr style="border: 2px solid #f4eee0;">
                </th>
            </tr>
        </table>
    </center>
    <br>
    <h1 align="center">Keranjang Barang</h1>
    <br>
    <center>
    <table border="1" class="table table-bordered" id="main">
        <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Jumlah Harga</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $queryData = "select *from keranjang where email='$email'";
        $resultData = mysqli_query($db, $queryData);
        while ($row = mysqli_fetch_assoc($resultData)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['namaBarang'] ?></td>
                <td><?= $row['jumlahBarang'] ?></td>
                <td><?= $row['jumlahHarga'] ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td>
                    <form action="keranjang.php?idTransaksi=<?= $row['idTransaksi'] ?>" method="post">
                        <center><button type="submit" name="buttonH">Hapus</button></center>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
        <?php
        $queryTotal = "select sum(jumlahHarga) as total from keranjang where email='$email'";
        $resultTotal = mysqli_query($db, $queryTotal);
        while ($row = mysqli_fetch_assoc($resultTotal)) {
            echo "";
            ?>
            <tr>
                <td colspan="3" align="center"><b>Total</b></td>
                <td colspan="3"><b><?= $row['total'] ?></b></td>
            </tr>
            <?php
        }
        ?>
    </table>
    </center>
    <?php
    $queryKeranjang = "select count(*) from keranjang where email='$email'";
    $resultKeranjang = mysqli_query($db, $queryKeranjang);
    while ($row = mysqli_fetch_assoc($resultKeranjang)) {
        if (!$row['count(*)'] == 0) {
            ?>
            <form action="keranjang.php" method="post">
                <!-- <a href="keranjang.php"> -->
                <button class="btn btn-warning" name="buttonCO">Check Out</button>
                <!-- </a> -->
            </form>
            <?php
        }
    }
    ?>
    <?php
    if (isset($_GET['idTransaksi'])) {
        $idTransaksi = $_GET['idTransaksi'];
        if (isset($_POST['buttonH'])) {
            $queryHapus = "delete from keranjang where idTransaksi='$idTransaksi'";
            $resultHapus = mysqli_query($db, $queryHapus);
            try {
                if ($resultHapus) {
                    header("Location: keranjang.php");
                    exit();
                } else {
                    die("Error");
                }
            } catch (mysqli_sql_exception) {
                die("Error");
            }
        }
    }
    if (isset($_POST['buttonCO'])) {
        $email = $_SESSION['email'];
        $queryCO = "insert into transaksi(idTransaksi, idBarang, email, namaBarang, jumlahBarang, jumlahHarga, tanggal) select idTransaksi, idBarang, email, namaBarang, jumlahBarang, jumlahHarga, tanggal from keranjang where email='$email'";
        $resultCO = mysqli_query($db, $queryCO);
        if ($resultCO) {
            try {
                // echo "<script>alert('berhasil');</script>";
                    $queryDeleteK = "delete from keranjang where email='$email'";
                    $resultDeleteK = mysqli_query($db, $queryDeleteK);
                header("Location: index.php");
                exit();
            } catch (mysqli_sql_exception) {
                // echo "<script>alert('gagal');</script>";
            }
        } else {
            // echo "<script>alert('gagal');</script>";
        }
    }
    ?>
</body>

</html>