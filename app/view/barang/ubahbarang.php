<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Barang</title>
        <link rel="shortcut icon" href="../../../assets/<?php echo $_SESSION['gambar']?>" type="image/x-icon">
        <?php 
            if($_SESSION['role'] == "admin"){
                require_once("../ui/header.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                exit;
            }
        ?>
        <script type="text/javascript">
        function rupiah() {
            var uang = document.getElementById('nominal').value;
            uang = Intl.NumberFormat('id-ID', {
                style: "currency",
                currency: "IDR"
            }).format(uang);
            document.getElementById("rupiahText").innerText = uang;
        }

        function rupiah1() {
            var uang = document.getElementById('nominal1').value;
            uang = Intl.NumberFormat('id-ID', {
                style: "currency",
                currency: "IDR"
            }).format(uang);
            document.getElementById("rupiahText1").innerText = uang;
        }
        </script>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Ubah Data Barang</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php 
                            if(isset($_GET['id_barang'])){
                                $id = htmlspecialchars($_GET['id_barang']);
                                $sql = "SELECT * FROM barang WHERE id_barang = $id";
                                $row = $configs->query($sql);
                            while($isi = $row->fetch_array()){
                        ?>
                        <form action="?aksi=ubah-barang" method="post">
                            <input type="hidden" name="id_barang" value="<?=$isi['id_barang']?>">
                            <div class="form-group">
                                <div class="mb-1"></div>
                                <div class="form-inline">
                                    <div class="form-label">
                                        <label for="" class="form-check-label">Nama Barang</label>
                                    </div>
                                    <input type="text" value="<?=$isi['nama_barang']?>" name="nama_barang"
                                        class="form-control" required placeholder="masukkan nama barang ..." id="">
                                </div>
                                <div class="mb-1"></div>
                                <div class="form-inline">
                                    <div class="form-label">
                                        <label for="" class="form-check-label">Kategori Barang</label>
                                    </div>
                                    <select name="id_kategori" class="form-control form-select" id="" required>
                                        <option value="">Pilih Kategori Barang</option>
                                        <?php 
                                            $row = $kategori->lihat();
                                            while($rwisi = mysqli_fetch_array($row)){
                                        ?>
                                        <option <?php if($isi['id_kategori'] == $rwisi['id_kategori']){?> selected
                                            <?php } ?> value="<?=$rwisi['id_kategori']?>">
                                            <?=$rwisi['nama_kategori']?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-1"></div>
                                <div class="form-inline">
                                    <div class="form-label">
                                        <label for="" class="form-check-label">Harga Beli</label>
                                    </div>
                                    <input type="text" name="harga_beli" value="<?=$isi['harga_beli']?>"
                                        class="form-control" required placeholder="masukkan harga beli barang ..."
                                        id="nominal">
                                    <small id="rupiahText"></small>
                                </div>
                                <div class="mb-1"></div>
                                <div class="form-inline">
                                    <div class="form-label">
                                        <label for="" class="form-check-label">Harga Jual</label>
                                    </div>
                                    <input type="text" name="harga_jual" value="<?=$isi['harga_jual']?>"
                                        class="form-control" required placeholder="masukkan harga jual barang ..."
                                        id="nominal1">
                                    <small id="rupiahText1"></small>
                                </div>
                                <div class="mb-1"></div>
                                <div class="form-inline">
                                    <div class="form-label">
                                        <label for="" class="form-check-label">Jumlah Stok</label>
                                    </div>
                                    <input type="text" name="jumlah_stok" value="<?=$isi['jumlah_stok']?>"
                                        class="form-control" required placeholder="masukkan stok barang ..." id="">
                                </div>
                                <div class="mb-1"></div>
                                <div class="form-inline">
                                    <div class="form-label">
                                        <label for="" class="form-check-label">Satuan Barang</label>
                                    </div>
                                    <select name="id_satuan" class="form-control form-select" id="" required>
                                        <option value="">Pilih Satuan Barang</option>
                                        <?php 
                                            $row = $satuan->lihat();
                                            while($risi = mysqli_fetch_array($row)){
                                        ?>
                                        <option <?php if($isi['id_satuan'] == $risi['id_satuan']){?> selected <?php } ?>
                                            value="<?=$risi['id_satuan']?>">
                                            <?=$risi['nama_satuan']?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-secondary">Update</button>
                                    <button type="button" class="btn btn-default"
                                        onclick="document.location.href = '?page=barang'">Cancel</button>
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