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
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
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
            color: white;
        }

        header {
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            border-bottom: 2px solid white;
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

        .image h3,
        .image form button {
            position: absolute;
            top: 40%;
            right: 16px;
            font-size: 2.5rem;
            font-weight: 300;
        }

        .image h3 {
            text-shadow: 0 0 8px #01c3f9;
        }

        .image form button {
            position: absolute;
            top: 50%;
            right: 16px;
            font-size: 2.5rem;
            font-weight: 300;
            transition: 0.3s ease;
        }

        .image form button:hover {
            box-shadow: 0 0 15px #01c3f9;
        }

        #box {
            padding: 130px 15px;
            color: black;
        }

        #box .container {
            width: 100%;
            height: 100vw;
        }

        .container .box-items {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }

        .box-item {
            margin-bottom: 50px;
            padding: 24px;
        }

        .box-item img {
            width: 100%;
            background-color: white;
        }

        .content a {
            color: white;
            text-decoration: none;
        }

        .content h4,
        .content p {
            margin-top: 12px;
            text-align: left;
        }

        .content h4 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .content p {
            font-size: 1.2rem;
            font-weight: 400;
        }

        ::-webkit-scrollbar {
            width: 14px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #ffffff;
            border-radius: 12px;
        }

        ::-webkit-scrollbar-track {
            background-color: #0F0F0F;
            width: 50px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <h1>Fragrance</h1>
        </div>
        <div class="navbar">
            <?php
            if ($_SESSION['access'] == "User") {
                ?>
                <a href="keranjang.php">Keranjang (<?php
                $queryK = "select count(*) as jumlah from keranjang where email='$email'";
                $resultK = mysqli_query($db, $queryK);
                while ($row = mysqli_fetch_assoc($resultK)) {
                    echo $row['jumlah'];
                }
                ?>)</a>
                <a href="riwayat.php">Riwayat Transaksi</a>
                <?php
            }else if($_SESSION['access']=="Admin"){
                ?>
                    <a href="dashboard.php">Dashboard</a>
                <?php
            }
            ?>
        </div>
        <form action="index.php" method="post"><button type="submit" name="logout" id="btn">Log Out</button></form>
    </header>
    <section id="beranda" style="padding: 100px 15px;">
        <div class="image" style="position: relative;">
            <img src="assets/img/641460.jpg" style="width: 100%;">
            <h3>Pesan parfum premium ini sekarang juga</h3>
            <form action="#box"><button>Pesan</button></form>
        </div>
    </section>
    <section id="box">
        <div class="container">
            <div class="box-items">
                <?php
                $querySelect = "select *from barang";
                $resultSelect = mysqli_query($db, $querySelect);
                while ($row = mysqli_fetch_array($resultSelect)) {
                    ?>
                    <div class="box-item">
                        <div class="content">
                            <a href="barang.php?id=<?= $row['idBarang'] ?>">
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['gambar']) . '" alt="Gambar Item" class="gambar"/>'; ?>
                                <h4><b><?= $row['namaBarang'] ?></b></h4>
                                <p><?= $row['jenis'] ?></p>
                                <p>Rp. <?= $row['harga'] ?></p>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <section id="footer">

    </section>
</body>

</html>