<?php 
if(isset($_GET['info'])){
    if($_GET['info'] == "ubah"){
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Informasi!</strong>
    <p>berhasil ubah pengaturan toko</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert"
        onclick="document.location.href = '?page=pengaturan'" aria-label="Close"></button>
</div>
<?php
    }else if($_GET['info'] == "hapus"){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Informasi!</strong>
    <p>berhasil hapus pengaturan toko</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert"
        onclick="document.location.href = '?page=pengaturan'" aria-label="Close"></button>
</div>
<?php
    }else if($_GET['info'] == "gagal"){
?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Informasi!</strong>
    <p>gagal menambahkan pengaturan toko</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert"
        onclick="document.location.href = '?page=pengaturan'" aria-label="Close"></button>
</div>
<?php
    }
}
?>