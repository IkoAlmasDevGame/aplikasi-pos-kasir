<?php
error_reporting(0);
require_once("../../database/koneksi.php");
if (!empty($_GET['cari'])) {
    if(isset($_POST['keyword'])){
        $cari = strip_tags(trim($_POST['keyword']));
    if($cari == ''){
        // $sql = "SELECT * from barang where kategori like '%$cari%' or nama_barang like '%$cari%' or kode_barang like '%$cari%'";
        // $hasil = $conn->query($sql);
    }else{    
        $sql = "SELECT barang.*, kategori.id_kategori, kategori.nama_kategori from barang inner join kategori on barang.id_kategori = kategori.id_kategori where nama_kategori like '%$cari%' or nama_barang like '%$cari%'";
        $row = $konfigs -> prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();        
    }
?>
<div class="table-responsive table-responsive-md mt-1">
    <table class="table table-sm w-100 table-bordered">
        <tr>
            <th>Nama Barang</th>
            <th>Nama Kategori</th>
            <th>Harga Jual</th>
            <th class="text-center">Opsional</th>
        </tr>
        <?php 
            foreach($hasil as $isi){
        ?>
        <tr>
            <td><?php echo $isi['nama_barang'] ?></td>
            <td><?php echo $isi['nama_kategori'] ?></td>
            <td>Rp. <?php echo number_format($isi['harga_jual']) ?> ,-</td>
            <td class="text-center">
                <a href="?aksi=tambah-list&id_barang=<?=$isi['id_barang']?>" aria-current="page"
                    class="btn btn-info btn-sm">
                    <i class="bi bi-plus"></i>
                </a>
            </td>
        </tr>
        <?php
            }
        ?>
    </table>
</div>
<?php
    } 
}
?>