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
require_once("../../model/model_kasir.php");
require_once("../../model/model_laporan.php");
require_once("../../model/model_pengaturan.php");
$kasir = new model\Penjualan($konfigs);
$laporan = new model\Laporan($konfigs);
// Controller
$pengguna = new controller\Authentication($configs);
$barang = new controller\Barang($configs);
$kategori = new controller\Kategori($configs);
$satuan = new controller\Satuan($configs);
$cashier = new controller\Cashier($konfigs);
$pengaturan = new controller\pengaturan($configs);

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

        case 'ubah-pengguna':
            require_once("../pengguna/ubah.php");
            break;

        case 'cashier':
            require_once("../kasir/cashier.php");
            break;

        case 'print-cashier':
            require_once("../kasir/print.php");
            break;

        case 'laporan':
            require_once("../laporan/laporan.php");
            break;

        case 'export-laporan-penjualan':
            require_once("../laporan/excel.php");
            break;

        case 'pengaturan':
            require_once("../pengaturan/toko.php");
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
        // Page Pengaturan Toko
        case 'ubahtoko':
            require_once("../pengaturan/ubahtoko.php");
            break;
            // Aksi Pengaturan Toko
            case 'ubah-toko':
                $pengaturan->ubah();
                break;
        // Page Pengaturan Toko

        // Page Pengguna
        case 'tambahpengguna':
            require_once("../pengguna/tambahpengguna.php");
            break;
        case 'ubahpengguna':
            require_once("../pengguna/ubahpengguna.php");
            break;
            // Aksi Pengguna
            case 'tambah-pengguna':
                $pengguna->buat();
                break;
            case 'ubah-pengguna':
                $pengguna->ubah();
                break;
            case 'hapus-pengguna':
                $pengguna->hapus();
                break;
        // Page Pengguna

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
        
        // Page Cashier
        case 'tambah-list':
            $cashier->list_keranjang();
            break;
        case 'edit-list':
            $cashier->edit_keranjang();
            break;
        case 'reset-keranjang':
            $cashier->ResetKeranjang();
            break;
        case 'reset-belanja':
            $cashier->ResetBelanja();
            break;
        case 'hapus-list':
            $cashier->hapusitem();
            break;
        // Page Cashier

        default:
            require_once("../../controller/controller.php");
            break;
    }
}

?>