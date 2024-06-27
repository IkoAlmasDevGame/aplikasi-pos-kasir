<?php 
if(isset($_GET['aksi'])){ 
    if($_GET['aksi'] == "tambahpengguna"){
?>
<li class="breadcrumb breadcrumb-item">
    <a href="?page=barang&aksi=tambahpengguna" aria-current="page" aria-label="Tambah Pengguna"
        class="text-decoration-none text-primary">Tambah Pengguna</a>
</li>
<?php
    }else if($_GET['aksi'] == "ubahpengguna"){
?>
<li class="breadcrumb breadcrumb-item">
    <a href="?page=pengguna&aksi=ubahpengguna&id_akun=<?=$_GET['id_akun']?>" aria-current="page"
        class="text-decoration-none text-primary">Ubah Barang</a>
</li>
<?php
    }
}
?>