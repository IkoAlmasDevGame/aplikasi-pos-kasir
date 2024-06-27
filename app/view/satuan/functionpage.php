<?php 
if(isset($_GET['aksi'])){ 
    if($_GET['aksi'] == "tambahsatuan"){
?>
<li class="breadcrumb breadcrumb-item">
    <a href="?page=barang&aksi=tambahsatuan" aria-current="page" class="text-decoration-none text-primary">Tambah
        Satuan</a>
</li>
<?php
    }else if($_GET['aksi'] == "ubahsatuan"){
?>
<li class="breadcrumb breadcrumb-item">
    <a href="?page=satuan&aksi=ubahsatuan&id_satuan=<?=$_GET['id_satuan']?>" aria-current="page"
        class="text-decoration-none text-primary">Ubah Barang</a>
</li>
<?php
    }
}
?>