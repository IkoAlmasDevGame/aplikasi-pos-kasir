<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Satuan</title>
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
                    <h4 class="card-title">Tambah Data Satuan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-responsive-md">
                        <form action="?aksi=tambah-satuan" method="post">
                            <div class="form-group">
                                <div class="form-inline">
                                    <div class="form-label">
                                        <label for="" class="form-check-label">Nama Satuan</label>
                                    </div>
                                    <input type="text" name="nama_satuan" maxlength="64" id="" class="form-control"
                                        required placeholder="masukkan jenis Satuan barang ...." aria-required="true">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-default"
                                        onclick="document.location.href = '?page=satuan'">Cancel</button>
                                    <button type="reset" class="btn btn-danger">Hapus Semua</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>