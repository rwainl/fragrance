<?php 
include "service/connect.php";
?>
<center>
        <table border="0" class="text-center" id="title">
            <tr>
                <th class="display-4">Toko Fragrance</th>
            </tr>
            <tr>
                <th class="display-6">List Barang</th>
            </tr>
            <tr>
                <th>
                    <hr style="border: 2px solid #f4eee0;">
                </th>
            </tr>
        </table>
    </center>
    <br>
    <h1 align="center">Jumlah List Barang : <?php 
        $queryJumlah = "select count(*) as jumlah from barang";
        $resultJumlah = mysqli_query($db, $queryJumlah);
        while($row = mysqli_fetch_assoc($resultJumlah)){
            echo $row['jumlah'];
        }
    ?></h1>
    <br>
    <table border="1" class="table table-bordered" id="main">
        <tr>
            <th>No.</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Jenis</th>
            <th>Deskripsi</th>
            <th>Stock</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $queryData = "select *from barang";
        $resultData = mysqli_query($db, $queryData);
        while ($row = mysqli_fetch_assoc($resultData)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['idBarang'] ?></td>
                <td><?= $row['namaBarang'] ?></td>
                <td><?= $row['jenis'] ?></td>
                <td><?= $row['deskripsi'] ?></td>
                <td><?= $row['stock'] ?></td>
                <td><?= $row['harga'] ?></td>
                <?php 
                echo "<td>";
                echo "<a href='edit.php?id=".$row['idBarang']."' class='btn btn-sn btn-warning'>Edit</a> ";
                echo "<a href='dBarang.php?id=".$row['idBarang']."' class='btn btn-sn btn-danger'>Hapus</a> ";
                echo "</td>";
                ?>
            </tr>
            <?php
        }
        ?>
    </table>
    </center>
    <a href="exportBarang.php">
        <button class="btn btn-warning">Download</button>
    </a>
    <?php 
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $queryHapus = "delete from barang where idBarang='$id'";
            $resultHapus = mysqli_query($db, $queryHapus);
            if($resultHapus){
                header("Location: dashboard.php");
                exit();
            }else{
                echo "<script>alert('Gagal Hapus');</script>";
            }
        }
    ?>