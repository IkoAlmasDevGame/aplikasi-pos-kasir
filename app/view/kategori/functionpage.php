<?php 
if(isset($_GET['aksi'])){ 
    if($_GET['aksi'] == "tambahkategori"){
?>
<li class="breadcrumb breadcrumb-item">
    <a href="?page=kategori&aksi=tambahkategori" aria-current="page" class="text-decoration-none text-primary">Tambah
        Kategori</a>
</li>
<?php
    }else if($_GET['aksi'] == "ubahkategori"){
?>
<li class="breadcrumb breadcrumb-item">
    <a href="?page=kategori&aksi=ubahkategori&id_kategori=<?=$_GET['id_kategori']?>" aria-current="page"
        class="text-decoration-none text-primary">Ubah Kategori</a>
</li>
<?php
    }
}
?>