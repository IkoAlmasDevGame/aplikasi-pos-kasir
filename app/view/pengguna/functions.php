<?php 
if(isset($_GET['info'])){
    if($_GET['info'] == "berhasil"){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Informasi!</strong>
    <p>berhasil menambahkan data pengguna</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="document.location.href = '?page=pengguna'"
        aria-label="Close"></button>
</div>
<?php        
    }else if($_GET['info'] == "ubah"){
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Informasi!</strong>
    <p>berhasil ubah data pengguna</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="document.location.href = '?page=pengguna'"
        aria-label="Close"></button>
</div>
<?php
    }else if($_GET['info'] == "hapus"){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Informasi!</strong>
    <p>berhasil hapus data pengguna</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="document.location.href = '?page=pengguna'"
        aria-label="Close"></button>
</div>
<?php
    }else if($_GET['info'] == "gagal"){
?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Informasi!</strong>
    <p>gagal menambahkan data pengguna</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="document.location.href = '?page=pengguna'"
        aria-label="Close"></button>
</div>
<?php
    }
}
?>