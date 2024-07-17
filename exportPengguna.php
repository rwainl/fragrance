<?php
include "service/connect.php";
// header("Content-type: application/vnd.ms-word");
// header("Content-Disposition: attachment;Filename=laporan-pengguna.doc");
echo "<script>window.print();</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <center>
        <table border="0" class="text-center" id="title">
            <tr>
                <th class="display-4">Toko Fragrance</th>
            </tr>
            <tr>
                <th class="display-6">Akun Pengguna</th>
            </tr>
            <tr>
                <th>
                    <hr style="border: 2px solid #f4eee0;">
                </th>
            </tr>
        </table>
    </center>
    <br>
    <h1 align="center">Jumlah Akun Pengguna : <?php
    $queryJumlah = "select count(*) as jumlah from akun where access='User'";
    $resultJumlah = mysqli_query($db, $queryJumlah);
    while ($row = mysqli_fetch_assoc($resultJumlah)) {
        echo $row['jumlah'];
    }
    ?></h1>
    <br>
    <table border="1" class="table table-bordered" id="main">
        <tr>
            <th>No.</th>
            <!-- <th>ID Transaksi</th> -->
            <th>Email</th>
            <th>Username</th>
            <!-- <th>Password</th> -->
            <th>Akses</th>
        </tr>
        <?php
        $no = 1;
        $queryData = "select *from akun where access='User'";
        $resultData = mysqli_query($db, $queryData);
        while ($row = mysqli_fetch_assoc($resultData)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['username'] ?></td>
                <!-- <td><?= $row['password'] ?></td> -->
                <td><?= $row['access'] ?></td>

            </tr>
            <?php
        }
        ?>
    </table>
    </center>

<?php
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $queryHapus = "delete from akun where email='$email'";
    $resultHapus = mysqli_query($db, $queryHapus);
    if ($resultHapus) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Gagal Hapus');</script>";
    }
}
?>
</body>
</html>