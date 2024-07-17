<?php
session_start();
ob_start();
include "service/connect.php";
if (!isset($_SESSION['isLogin'])) {
    header("Location: login.php");
}
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
}
if (isset($_POST['buttonUser'])) {
    $_SESSION['content'] = "User";
} else if (isset($_POST['buttonTransaksi'])) {
    $_SESSION['content'] = "Transaksi";
} else {
    $_SESSION['content'] = "Barang";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
            font-family: "Fira Sans", sans-serif;
        }

        body {
            background-color: black;
            /* color: white; */
        }

        header {
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            border-bottom: 2px solid white;
            color: white;
        }

        header .logo {
            margin-left: 15px;
            padding-top: 12px;
            padding-bottom: 12px;
            align-content: center;
        }

        header .logo h1 {
            font-size: 1.8rem;
            font-weight: 400;
        }

        header .navbar {
            padding-top: 12px;
            padding-bottom: 12px;
            align-content: center;
        }

        header .navbar a {
            text-decoration: none;
            margin-left: 8px;
            margin-right: 8px;
            color: white;
        }

        header form {
            margin-right: 15px;
            padding-top: 12px;
            padding-bottom: 12px;
            align-content: center;
        }

        form button {
            padding: 4px;
            border-radius: 5px;
            cursor: pointer;
        }

        #box {
            padding: 120px 0;
            width: 100%;
            height: auto;
            color: white;
        }

        #box .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }

        .container .item {
            border: 2px solid white;
            padding: 12px;
            margin: 12px;
        }

        .item h3 {
            font-size: 1.6rem;
            font-weight: 400;
        }

        .item h5 {
            font-size: 1.3rem;
            font-weight: 300;
        }

        #table-content {
            /* background-color: grey; */
            padding: 120px 0px;
            width: 100%;
            height: auto;
        }

        #table-content .content {
            margin-left: 20px;
            margin-right: 20px;
            background-color: white;
            height: auto;
            padding: 20px;
        }

        .item button {
            background: transparent;
            color: white;
            border: 0px;
            margin-bottom: 12px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <h1>Dashboard</h1>
        </div>
        <div class="navbar">
            <a href="index.php">Landing Page</a>
            <a href="form.php">Import</a>
            <!-- <a href="index.php">List Barang</a>
            <a href="index.php">Transaksi</a> -->
        </div>
        <form action="index.php" method="post"><button type="submit" name="logout" id="btn">Log Out</button></form>
    </header>
    <section id="box">
        <div class="container">
            <div class="item">
                <h3>Jumlah Pengguna</h3>
                <h5><?php
                $queryPengguna = "select count(*) as jumlah from akun where access='User'";
                $resultPengguna = mysqli_query($db, $queryPengguna);
                while ($row = mysqli_fetch_assoc($resultPengguna)) {
                    echo $row['jumlah'];
                }
                ?></h5>
                <hr>
                <form action="dashboard.php" method="post"><button type="submit" name="buttonUser">Lihat
                        Selengkapnya</button></form>
            </div>
            <div class="item">
                <h3>Jumlah Transaksi</h3>
                <h5><?php
                $queryTransaksi = "select count(*) as jumlah from transaksi";
                $resultTransaksi = mysqli_query($db, $queryTransaksi);
                while ($row = mysqli_fetch_assoc($resultTransaksi)) {
                    echo $row['jumlah'];
                }
                ?></h5>
                <hr>
                <form action="dashboard.php" method="post"><button type="submit" name="buttonTransaksi">Lihat
                        Selengkapnya</button></form>
            </div>
            <div class="item">
                <h3>Jumlah Barang</h3>
                <h5><?php
                $queryBarang = "select count(*) as jumlah from barang";
                $resultBarang = mysqli_query($db, $queryBarang);
                while ($row = mysqli_fetch_assoc($resultBarang)) {
                    echo $row['jumlah'];
                }
                ?></h5>
                <hr>
                <form action="dashboard.php" method="post"><button type="submit" name="buttonBarang">Lihat
                        Selengkapnya</button></form>
            </div>
        </div>
    </section>
    <section id="table-content">
        <div class="content">
            <?php
            if ($_SESSION['content'] == "User") {
                include "dPengguna.php";
            } else if ($_SESSION['content'] == "Barang") {
                include "dBarang.php";
            } else if ($_SESSION['content'] == "Transaksi") {
                include "dTransaksi.php";
            } else {
                include "dBarang.php";
            }
            ?>
        </div>
    </section>
</body>

</html>