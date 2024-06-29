<?php 
if(isset($_GET['aksi'])){ 
    if($_GET['aksi'] == "ubahtoko"){
?>
<li class="breadcrumb breadcrumb-item">
    <a href="?page=pengaturan&aksi=ubahtoko&id_sistem=<?=$_GET['id_sistem']?>" aria-current="page"
        class="text-decoration-none text-primary">Ubah Pengaturan Toko</a>
</li>
<?php
    }
}
?>