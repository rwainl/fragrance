<?php 
    include "service/connect.php";
?>
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
        while($row = mysqli_fetch_assoc($resultJumlah)){
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
            <th>Password</th>
            <th>Akses</th>
            <th>Aksi</th>
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
                <td><?= $row['password'] ?></td>
                <td><?= $row['access'] ?></td>
                <?php 
                echo "<td>";
                echo "<a href='editPengguna.php?email=".$row['email']."' class='btn btn-sn btn-warning'>Edit</a> ";
                echo "<a href='dPengguna.php?email=".$row['email']."' class='btn btn-sn btn-danger'>Hapus</a> ";
                echo "</td>";
                ?>
            </tr>
            <?php
        }
        ?>
    </table>
    </center>
    <a href="exportPengguna.php">
        <button class="btn btn-warning">Download</button>
    </a>
    <?php 
        if(isset($_GET['email'])){
            $email = $_GET['email'];
            $queryHapus = "delete from akun where email='$email'";
            $resultHapus = mysqli_query($db, $queryHapus);
            if($resultHapus){
                header("Location: dashboard.php");
                exit();
            }else{
                echo "<script>alert('Gagal Hapus');</script>";
            }
        }
    ?>