<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>pengaturan toko</title>
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
        <div class="container container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="panel-heading fw-lighter"><i class="bi bi-gear"></i> pengaturan</h4>
                    <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=beranda" aria-current="page" class="text-decoration-none text-primary"><i
                                    class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb breadcrumb-item">
                            <a href="?page=pengaturan" aria-current="page"
                                class="text-decoration-none text-primary">pengaturan toko</a>
                        </li>
                        <?php require_once("../pengaturan/functionpage.php") ?>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Pengaturan Toko</h4>
                    <?php require_once("../pengaturan/functions.php") ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-1">
                        <table class="table table-sm w-100 table-bordered" id="example2">
                            <thead>
                                <tr>
                                    <th class="text-center">Flags</th>
                                    <th>Nama Toko</th>
                                    <th>Nama Pemilik Toko</th>
                                    <th class="text-center">Logo Toko</th>
                                    <th class="text-center">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM sistem WHERE flags = '1' order by id_sistem asc";
                                    $row = $configs->query($sql);
                                    while($isi = $row->fetch_array()){
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $isi['flags'] ?></td>
                                    <td><?php echo $isi['nama_toko'] ?></td>
                                    <td><?php echo $isi['nama_pemilik'] ?></td>
                                    <td class="text-center">
                                        <img src="../../../assets/<?=$isi['logo']?>"
                                            class="img-rounded col-sm-1 col-md-2 img-fluid"
                                            alt="<?php echo $isi['nama_toko'] ?>">
                                    </td>
                                    <td class="text-center">
                                        <a href="?page=pengaturan&aksi=ubahtoko&id_sistem=<?=$isi['id_sistem']?>"
                                            aria-current="page" class="btn btn-sm btn-warning mt-1 mt-lg-1">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>