<?php 
require_once("../../database/koneksi.php");
$sql = "SELECT * FROM sistem WHERE flags = '1' order by id_sistem asc";
$row = $configs->query($sql);
$hasil = $row->fetch_assoc();
$_SESSION['gambar'] = $hasil['logo'];

// Model & Controller
// Model
require_once("../../controller/controller.php");
require_once("../../model/model_pengguna.php");
require_once("../../model/model_barang.php");
require_once("../../model/model_kategori.php");
require_once("../../model/model_satuan.php");
// Controller
$pengguna = new controller\Authentication($configs);
$barang = new controller\Barang($configs);
$kategori = new controller\Kategori($configs);
$satuan = new controller\Satuan($configs);

if(!isset($_GET['page'])){
    require_once("../dashboard/index.php");
}else{
    switch ($_GET['page']) {
        case 'beranda':
            require_once("../dashboard/index.php");
            break;

        case 'barang':
            require_once("../barang/barang.php");
            break;

        case 'kategori':
            require_once("../kategori/kategori.php");
            break;

        case 'satuan':
            require_once("../satuan/satuan.php");
            break;

        case 'pengguna':
            require_once("../pengguna/pengguna.php");
            break;

        case 'keluar':
            if(isset($_SESSION['status'])){
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            header("location:../auth/login.php");
            exit(0);
            break;
        
        default:
            require_once("../dashboard/index.php");
            break;
    }
}

if(!isset($_GET['aksi'])){
    require_once("../../controller/controller.php");
}else{
    switch ($_GET['aksi']) {
        // Page Barang
        case 'tambahbarang':
            require_once("../barang/tambahbarang.php");
            break;
        case 'ubahbarang':
            require_once("../barang/ubahbarang.php");
            break;
            // Aksi Barang
            case 'tambah-barang':
                $barang->buat();
                break;
            case 'ubah-barang':
                $barang->ubah();
                break;
            case 'restok-barang':
                $barang->stokbarang();
                break;
            case 'hapus-barang':
                $barang->hapus();
                break;
        // Page Barang

        // Page Kategori
        case 'tambahkategori':
            require_once("../kategori/tambahkategori.php");
            break;
        case 'ubahkategori':
            require_once("../kategori/ubahkategori.php");
            break;
            // Aksi Kategori
            case 'tambah-kategori':
                $kategori->buat();
                break;
            case 'ubah-kategori':
                $kategori->ubah();
                break;
            case 'hapus-kategori':
                $kategori->hapus();
                break;
        // Page Kategori

        // Page Satuan
        case 'tambahsatuan':
            require_once("../satuan/tambahsatuan.php");
            break;
        case 'ubahsatuan':
            require_once("../satuan/ubahsatuan.php");
            break;
            // Aksi Satuan
            case 'tambah-satuan':
                $satuan->buat();
                break;
            case 'ubah-satuan':
                $satuan->ubah();
                break;
            case 'hapus-satuan':
                $satuan->hapus();
                break;
        // Page Satuan
        
        default:
            require_once("../../controller/controller.php");
            break;
    }
}

?>