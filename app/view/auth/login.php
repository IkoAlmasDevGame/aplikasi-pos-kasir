<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aplikasi Pos Kasir</title>
        <?php 
            require_once("../../database/koneksi.php");
            $sql = "SELECT * FROM sistem WHERE flags = '1' order by id_sistem asc";
            $row = $configs->query($sql);
            $hasil = $row->fetch_assoc();
            $_SESSION['gambar'] = $hasil['logo'];

            require_once("../../model/model_pengguna.php");
            require_once("../../controller/controller.php");
            $pengguna = new controller\Authentication($configs);

            if(!isset($_GET['aksi'])){
                require_once("../../controller/controller.php");
            }else{
                switch ($_GET['aksi']) {
                    case 'signin':
                        $pengguna->signin();
                        break;
                    
                    default:
                        require_once("../../controller/controller.php");
                        break;
                }
            }
        ?>
        <link rel="shortcut icon" href="../../../assets/<?php echo $_SESSION['gambar']?>" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="./styles.css" type="text/css">
    </head>

    <body onload="startTime()">
        <div class="container-fluid pt-5 mt-5">
            <div class="d-grid justify-content-center align-items-center flex-wrap">
                <div class="container-fluid p-3 m-3 rounded-1">
                    <div class="card">
                        <div class="col-sm-12 col-md-12 mb-1 mt-1">
                            <div class="d-flex justify-content-start align-items-center
                                 flex-wrap ms-2 mt-1 ms-lg-2 mt-lg-1">
                                <img src="../../../assets/<?php echo $_SESSION['gambar']?>"
                                    alt="<?php echo $hasil['nama_toko']?>">
                            </div>
                            <div class="card-header bg-transparent border-0">
                                <h6 class="card-title text-end">Aplikasi Pos Kasir -
                                    <?php echo $hasil['nama_toko'] ?></h6>
                            </div>
                        </div>
                        <div class="border border-top mb-1"></div>
                        <?php 
                            if(isset($_GET['info'])){
                                if($_GET['info'] == "gagal"){
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Informasi!</strong>
                            <p>username atau email dan password anda salah, coba lagi ...</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                onclick="document.location.href = 'login.php'" aria-label="Close"></button>
                        </div>
                        <?php
                            }
                        }
                        ?>
                        <div class="border border-top mb-1"></div>
                        <div class="card-body">
                            <div class="form-group">
                                <form action="?aksi=signin" method="post">
                                    <div class="form-inline">
                                        <div class="form-label label-default">
                                            <label for="userInput">username atau email : </label>
                                        </div>
                                        <input type="text" name="userInput" class="form-control" required
                                            aria-required="true"
                                            placeholder="masukkan alamat email atau username anda ...." id="userInput">
                                    </div>
                                    <div class="mb-2"></div>
                                    <div class="form-inline">
                                        <div class="form-label label-default">
                                            <label for="password">kata sandi : </label>
                                        </div>
                                        <input type="password" name="password" class="form-control" required
                                            aria-required="true" placeholder="masukkan kata sandi anda ...."
                                            id="password">
                                    </div>
                                    <div class="card-footer">
                                        <div class="gap-2 d-flex justify-content-center align-items-center flex-wrap">
                                            <button type="submit" class="btn btn-primary col-sm-12 col-md-3">
                                                Login
                                            </button>
                                            <div class="mb-1"></div>
                                            <button type="reset" class="btn btn-danger col-sm-12 col-md-3">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center" id="text"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="script.js"></script>
    </body>

</html>