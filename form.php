<?php 
    session_start();
    ob_start();
    include "service/connect.php";
    if(isset($_POST['pesan'])){
        $id = time();
        $namaBarang = $_POST['namaBarang'];
        $jenis = $_POST['jenis'];
        $deskripsi = $_POST['deskripsi'];
        $stock = $_POST['stock'];
        $harga = $_POST['harga'];
        $gambar = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
        $queryImport = "insert into barang values('$id','$namaBarang','$jenis','$deskripsi','$stock','$harga','$gambar')";
        $resultImport = mysqli_query($db, $queryImport);
        if($resultImport){
            try{
                header("Location: index.php");
                exit();
            }catch(mysqli_sql_exception){
                echo "<script>alert('Gagal');</script>";
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
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .content h1 {
            font-size: 2.2rem;
            font-weight: 400;
            margin-bottom: 30px;
        }

        form {
            width: 50%;
            height: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* background-color: grey; */
            border: 3px solid white;
            border-radius: 16px;
            padding-top: 50px;
            padding-bottom: 50px;
            box-shadow: 0 0 20px white;
        }

        input, textarea{
            width: 70%;
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 16px;
        }
        textarea{
            resize: none;
        }
        select{
            width: 72.5%;
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 16px;
        }
        button{
            width: auto;
            padding: 8px;
            border-radius: 8px;
            margin-top: 16px;
            background-color: white;
            cursor: pointer;
            transition: 0.3s ease;
            border: 2px solid black;
        }
        button:hover{
            box-shadow: 0 0 8px white;
            background-color: black;
            color: white;
            border: 2px solid white;
        }
    </style>
</head>

<body>
    <center>
        <div class="content">
            <h1>Form Barang</h1>
            <form action="form.php" method="post" enctype="multipart/form-data">
                <input type="text" name="namaBarang" placeholder="Nama Barang" required>
                <input type="text" name="jenis" placeholder="Jenis Barang" required>
                <textarea
            name="deskripsi"
            id=""
            cols="30"
            rows="10"
            placeholder="Deskripsi" required
          ></textarea>
                <input type="number" name="stock" placeholder="Jumlah Barang" required>
                <input type="number" name="harga" placeholder="Harga" required>
                <input type="file" name="gambar" required>
          <button type="submit" name="pesan">Kirim</button>
            </form>
        </div>
    </center>
</body>

</html>