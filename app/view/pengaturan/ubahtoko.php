<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pengaturan Toko</title>
        <link rel="shortcut icon" href="../../../assets/<?php echo $_SESSION['gambar']?>" type="image/x-icon">
        <?php 
            if($_SESSION['role'] == "admin"){
                require_once("../ui/header.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                exit;
            }
        ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Ubah Pengaturan Toko</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-responsive-md">
                        <?php 
                            if(isset($_GET['id_sistem'])){
                                $id = htmlspecialchars($_GET['id_sistem']);
                                $sql = "SELECT * FROM sistem WHERE id_sistem = '$id'";
                                $row = $configs->query($sql);
                            while($isi = $row->fetch_array()){

                        ?>
                        <form action="?aksi=ubah-toko" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="id_sistem" value="<?=$isi['id_sistem']?>">
                                <input type="hidden" name="flags" value="<?=$isi['flags']?>">
                                <div class="form-inline mt-1">
                                    <div class="form-label">
                                        <label for="" class="form-check-label">Nama Toko</label>
                                    </div>
                                    <input type="text" name="nama_toko" value="<?=$isi['nama_toko']?>" maxlength="255"
                                        id="" class="form-control" required aria-required="true">
                                </div>
                                <div class="form-inline mt-1">
                                    <div class="form-label">
                                        <label for="" class="form-check-label">Nama Pemilik</label>
                                    </div>
                                    <input type="text" name="nama_pemilik" value="<?=$isi['nama_pemilik']?>"
                                        maxlength="255" id="" class="form-control" required aria-required="true">
                                </div>
                                <div class="form-inline mt-1">
                                    <div class="form-label">
                                        <label for="">Preview Logo</label>
                                    </div>
                                    <div class="form-icon">
                                        <img src="../../../assets/<?=$isi['logo']?>" id="preview" alt=""
                                            class="img-rounded col-sm-2 col-md-2 img-fluid">
                                    </div>
                                    <div class="form-check-input">
                                        <input type="file" name="logo" accept="image/*" class="form-control-file"
                                            required onchange="previewImage(this)" aria-required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-secondary">Update</button>
                                    <button type="button" class="btn btn-default"
                                        onclick="document.location.href = '?page=pengaturan'">Cancel</button>
                                    <button type="reset" class="btn btn-danger">Hapus Semua</button>
                                </div>
                            </div>
                        </form>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>