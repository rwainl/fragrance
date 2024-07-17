<?php
session_start();
ob_start();
include "service/connect.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $queryBarang = "select *from barang where idBarang='$id'";
    $resultBarang = mysqli_query($db, $queryBarang);
    while($row = mysqli_fetch_array($resultBarang)){
        if (isset($_POST['add'])) {
            $idTransaksi = time();
            $idBarang = $row['idBarang'];
            $email = $_SESSION['email'];
            $namaBarang = $row['namaBarang'];
            $jumlahBarang = $_POST['jumlahBarang'];
            $jumlahHarga = $jumlahBarang * $row['harga'];
            $tanggal = $_POST['tanggal'];
            $queryAdd = "insert into keranjang values('$idTransaksi','$idBarang','$email','$namaBarang','$jumlahBarang','$jumlahHarga','$tanggal')";
            $resultAdd = mysqli_query($db, $queryAdd);
            if($resultAdd){
                try{
                    header("Location: index.php");
                    exit();
                }catch(mysqli_sql_exception){
                    echo "<script>alert('Gagal Membeli');</script>";
                }
            }
        }else if(isset($_POST['edit'])){
            header("Location: edit.php?id=$id");
            exit();
        }else if(isset($_POST['hapus'])){
            $queryHapus = "delete from barang where idBarang='$id'";
            $resultHapus = mysqli_query($db, $queryHapus);
            try{
                header("Location: index.php");
                exit();
            }catch(mysqli_sql_exception){
                echo "<script>alert('Gagal Menghapus');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan</title>
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

        .content {
            padding: 130px 15px;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
        }

        img {
            width: 45%;
            background-color: white;
            margin-right: 10px;
        }

        form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* align-content: center; */
        }

        form p, form h1{
            text-align: left;
            margin-bottom: 10px;
        }

        input{
            margin-top: 16px;
            width: 40%;
            padding: 8px;
            border-radius: 8px;
        }

        button{
            margin-top: 16px;
            padding: 8px;
            border: 1px solid white;
            background-color: black;
            color: white;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover{
            background-color: white;
            color: black;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <center>
        <div class="content">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $querySelect = "select *from barang where idBarang='$id'";
                $resultSelect = mysqli_query($db, $querySelect);
                while ($row = mysqli_fetch_array($resultSelect)) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['gambar']) . '" alt="Gambar Item" class="gambar"/>';
                    ?>
                    <form action="barang.php?id=<?= $row['idBarang']?>" method="post">
                        <h1><?= $row['namaBarang']?></h1>
                        <p><?= $row['deskripsi']?></p>
                        <p>Rp. <?= $row['harga']?></p>
                        <hr>
                        <input type="<?php if($_SESSION['access']=="User"){echo "number";}else{echo "hidden";}?>" name="jumlahBarang" placeholder="Jumlah Barang" required>
                        <input type="hidden" name="tanggal" value="<?php echo date('d-m-Y')?>">
                        <?php 
                            if($_SESSION['access']=="User"){
                                ?>
                                <button type="submit" name="add">Tambah ke Keranjang</button>
                                <?php
                            }else{
                                ?>
                                <button type="submit" name="edit">Edit Barang</button>
                                <button type="submit" name="hapus">Hapus Barang</button>
                                <?php
                            }
                        ?>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </center>
</body>

</html>