<?php 
if(isset($_GET['aksi'])){ 
    if($_GET['aksi'] == "tambahbarang"){
?>
<li class="breadcrumb breadcrumb-item">
    <a href="?page=barang&aksi=tambahbarang" aria-current="page" class="text-decoration-none text-primary">Tambah
        Barang</a>
</li>
<?php
    }else if($_GET['aksi'] == "ubahbarang"){
?>
<li class="breadcrumb breadcrumb-item">
    <a href="?page=barang&aksi=ubahbarang&id_barang=<?=$_GET['id_barang']?>" aria-current="page"
        class="text-decoration-none text-primary">Ubah Barang</a>
</li>
<?php
    }
}
?>