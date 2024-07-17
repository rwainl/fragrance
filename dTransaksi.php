<?php 
    include "service/connect.php";
    
?>
<center>
        <table border="0" class="text-center" id="title">
            <tr>
                <th class="display-4">Toko Fragrance</th>
            </tr>
            <tr>
                <th class="display-6">List Transaksi</th>
            </tr>
            <tr>
                <th>
                    <hr style="border: 2px solid #f4eee0;">
                </th>
            </tr>
        </table>
    </center>
    <br>
    <h1 align="center">Jumlah List Transaksi : <?php 
        $queryJumlah = "select count(*) as jumlah from transaksi";
        $resultJumlah = mysqli_query($db, $queryJumlah);
        while($row = mysqli_fetch_assoc($resultJumlah)){
            echo $row['jumlah'];
        }
    ?></h1>
    <br>
    <table border="1" class="table table-bordered" id="main">
        <tr>
            <th>No.</th>
            <th>ID Transaksi</th>
            <th>ID Barang</th>
            <th>Email</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $queryData = "select *from transaksi";
        $resultData = mysqli_query($db, $queryData);
        while ($row = mysqli_fetch_assoc($resultData)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['idTransaksi'] ?></td>
                <td><?= $row['idBarang'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['namaBarang'] ?></td>
                <td><?= $row['jumlahBarang'] ?></td>
                <td><?= $row['jumlahHarga'] ?></td>
                <td><?= $row['tanggal'] ?></td>
                <?php 
                echo "<td>";
                echo "<a href='dTransaksi.php?id=".$row['idTransaksi']."' class='btn btn-sn btn-danger'>Hapus</a> ";
                echo "</td>";
                ?>
            </tr>
            <?php
        }
        ?>
    </table>
    </center>
    <a href="exportTransaksi.php">
        <button class="btn btn-warning">Download</button>
    </a>
    <?php 
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $queryHapus = "delete from transaksi where idTransaksi='$id'";
            $resultHapus = mysqli_query($db, $queryHapus);
            if($resultHapus){
                header("Location: dashboard.php");
                exit();
            }else{
                echo "<script>alert('Gagal Hapus');</script>";
            }
        }
    ?>