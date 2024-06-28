<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kasir Penjualan</title>
        <link rel="shortcut icon" href="../../../assets/<?php echo $_SESSION['gambar']?>" type="image/x-icon">
        <?php 
            if($_SESSION['role'] == "cashier"){
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
            <div class="panel panel-default">
                <div class="panel-body bg-body-tertiary">
                    <h4 class="panel-heading">
                        <i class="fa fa-shopping-cart fa-1x"></i>
                        Kasir Penjualan
                    </h4>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="card shadow col-sm-12 col-md-4 mb-auto">
                    <div class="card-header py-2">
                        <div class="card-body">
                            <div class="form-inline mt-1">
                                <div class="d-flex justify-content-start align-items-center flex-wrap gap-1">
                                    <label for="">search cari barang : </label>
                                    <div class="col-sm-12 col-md-12">
                                        <input type="text" id="cari" class="form-control" name="cari" required
                                            placeholder="Nama Kategori / Nama Barang" aria-required="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-sm-12 col-md-7">
                    <div class="card-header py-2">
                        <h5 class="card-title"><i class="fa fa-list"></i> Hasil Pencarian</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="hasil_cari"></div>
                            <div id="tunggu"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-auto"></div>
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h5><i class="fa fa-shopping-cart"></i> KASIR PENJUALAN
                        <div class="col-md-offset-0 pt-3 pt-lg-3">
                            <a class="btn btn-danger" aria-current="page" aria-label="RESET KERANJANG"
                                onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');"
                                href="?aksi=reset-keranjang">
                                <b>RESET KERANJANG</b></a>
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="keranjang">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>
                                    <label for="">Tanggal Hari ini : </label>
                                    <input type="text" readonly="readonly" class="form-control"
                                        value="<?php echo date("j F Y, G:i"); ?>" name="tanggal_input">
                                </td>
                            </tr>
                        </table>
                        <table class="table table-sm w-100 table-bordered" id="example2">
                            <thead>
                                <tr>
                                    <th style="width:5%; min-width:5%;">No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Jual</th>
                                    <th>Jumlah Beli</th>
                                    <th>Total Belanja</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $hasil = $cashier->lihat();
                                    $total_bayar = 0;
                                    foreach($hasil as $isi){
                                ?>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $isi["nama_barang"]; ?></td>
                                <td>Rp. <?php echo number_format($isi["harga_jual"]); ?> ,-</td>
                                <form action="?aksi=edit-list" method="post">
                                    <td>
                                        <input type="number" name="jumlah" class="form-control"
                                            value="<?=$isi["jumlah"]?>" required>
                                        <input type="hidden" name="id_penjualan" required
                                            value="<?php echo $isi['id_penjualan']; ?>">
                                        <input type="hidden" name="id_barang" required
                                            value="<?php echo $isi['id_barang']; ?>">
                                    </td>
                                    <td>Rp. <?php echo number_format($isi["total"]); ?> ,-</td>
                                    <td>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                </form>
                                <a href="?aksi=hapus-list&id_penjualan=<?=$isi['id_penjualan']?>&id_barang=<?=$isi['id_barang']?>"
                                    aria-current="page" class="btn btn-danger">
                                    <i class="fa fa-times"></i>
                                </a>
                                </td>
                                <?php
                                $no++;
                                $total_bayar += $isi['total'];
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br>
                        <?php $hasil = $cashier->sum(); ?>
                        <div id="kasirnya">
                            <table class="table table-striped">
                                <?php 
                                    $bayar = 0;
                                    $discount = 0;
                                    $hitungDiscount = 0;
                                    
                                    if(isset($_GET['nota'])){
                                        if($_GET["nota"]=="yes"){
                                        $total = $_POST['total'];
                                        $bayar = $_POST['bayar'];
                                        $discount = $_POST['discount'];
                                        
                                            if(!empty($bayar)){
                                                $hitung = 0;
                                                $totDiscount = ($total * $discount)/100;
                                                $hitungDiscount = $bayar - $totDiscount;
                                                if($bayar >= $total){
                                                    $id_barang = $_POST['id_barang'];
                                                    $harga_jual = $_POST['harga_jual'];
                                                    $jumlah = $_POST['jumlah'];
                                                    $total = $_POST['total1'];
                                                    $tanggal_input = $_POST['tanggal_input'];
                                                    $periode = $_POST['periode'];
                                                    $jumlah_beli = count($id_barang);
                                                    for($x=0; $x < $jumlah_beli; $x++){
                                                        $rwBarang = "SELECT * FROM barang WHERE id_barang = ?";
                                                        $sqBarang = $konfigs->prepare($rwBarang);
                                                        $sqBarang->execute(array($id_barang[$x]));
                                                        $hsl = $sqBarang->fetch();

                                                        $d = array($id_barang[$x],$harga_jual[$x],$jumlah[$x],$total[$x],$tanggal_input[$x],$periode[$x]);
                                                        $sqNota = "INSERT INTO nota (id_barang,harga_jual,jumlah,total,tanggal_input,periode) VALUES(?,?,?,?,?,?)";
                                                        $rwNota = $konfigs->prepare($sqNota);
                                                        $rwNota->execute($d);
                                                        $sqNotaBackUp = "INSERT INTO v_nota (id_barang,harga_jual,jumlah,total,tanggal_input,periode) VALUES(?,?,?,?,?,?)";
                                                        $rwNotaBackUp = $konfigs->prepare($sqNotaBackUp);
                                                        $rwNotaBackUp->execute($d);

                                                        $tstok = $hsl['jumlah_stok'];
                                                        $ikb = $hsl['id_barang'];
                                                        $total_stok = $tstok - $jumlah[$x];

                                                        $sql_stok = "UPDATE barang SET jumlah = ? WHERE kode_barang = ?";
                                                        $row_stok = $konfigs->prepare($sql_stok);
                                                        $row_stok->execute(array($total_stok, $ikb)); 
                                                    }
                                                    echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
                                                }else{
                                                    echo '<script>alert("Uang Kurang ! Rp.'.$hitung.'");</script>';
                                                }
                                            }
                                        }
                                    }
                                ?>
                                <form action="../ui/header.php?page=cashier&nota=yes#kasirnya" method="post">
                                    <tbody>
                                        <?php 
                                            foreach ($hasil as $isi) {
                                        ?>
                                        <input type="hidden" name="id_barang[]"
                                            value="<?php echo $isi['id_barang']; ?>">
                                        <input type="hidden" name="harga_jual[]"
                                            value="<?php echo $isi['harga_jual']; ?>">
                                        <input type="hidden" name="jumlah[]" value="<?php echo $isi['jumlah']; ?>">
                                        <input type="hidden" name="total1[]" value="<?php echo $isi['total']; ?>">
                                        <input type="hidden" name="tanggal_input[]"
                                            value="<?php echo $isi['tanggal_input']; ?>">
                                        <input type="hidden" name="periode[]" value="<?php echo date('m-Y'); ?>">
                                        <?php
                                        $no++;
                                            }
                                        ?>
                                        <tr>
                                            <td>Total Semua</td>
                                            <td>
                                                <input type="text" class="form-control" name="total"
                                                    value="<?= $total_bayar; ?>">
                                            </td>
                                            <td>Bayar</td>
                                            <td>
                                                <input type="text" class="form-control" name="bayar"
                                                    value="<?= $bayar;?>" required>
                                            </td>
                                            <td>Discount</td>
                                            <td>
                                                <input type="text" class="form-control" name="discount"
                                                    value="<?= $discount;?>" required>
                                            </td>
                                            <td>
                                                <button class="btn btn-success btn-sm" type="submit">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    Bayar
                                                </button>
                                            </td>
                                            <td>
                                                <?php 
                                                    if(isset($_GET['nota'])){
                                                        if($_GET["nota"]=="yes"){
                                                ?>
                                                <a href="?aksi=reset-belanja" aria-current="page"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="javascript:return confirm('Apakah anda ingin reset belanjaan ?');">
                                                    Reset Nota</a>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </form>
                                <tr>
                                    <td>Kembali</td>
                                    <td>
                                        <input type="text" class="form-control" name="kembali"
                                            value="<?php echo $hitungDiscount;?>">
                                    </td>
                                    <td colspan="5"></td>
                                    <td>
                                        <a href="" aria-current="page" target="_blank">
                                            <button class="btn btn-secondary btn-sm">
                                                <i class="fa fa-print"></i> Print Untuk Bukti Pembayaran
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once("../ui/footer.php") ?>