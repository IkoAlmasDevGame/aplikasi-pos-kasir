<?php 
namespace controller;
use model\Pengguna;
use model\Briefcase;
use model\Category;
use model\Unit;
use model\Penjualan;
use model\Laporan;
use model\setting;

class Authentication {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Pengguna($konfig);
    }

    public function signin(){
        session_start();
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : $_POST['userInput'];
        $password = md5($_POST['password'],  false);
        
        $row = $this->konfig->login($userInput,$password);
        if($row === true){
            return true;
        }else{
            return false;
        }
    }

    public function buat(){
        $nama = htmlentities($_POST['nama_pengguna']) ? htmlspecialchars($_POST['nama_pengguna']) : $_POST['nama_pengguna'];
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : $_POST['username'];
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : $_POST['email'];
        $password = md5(htmlspecialchars($_POST['password']), false);
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : $_POST['role'];

        $config = $this->konfig->create($nama,$username,$email,$password,$role);
        if($config === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $nama = htmlentities($_POST['nama_pengguna']) ? htmlspecialchars($_POST['nama_pengguna']) : $_POST['nama_pengguna'];
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : $_POST['username'];
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : $_POST['email'];
        $password = md5(htmlspecialchars($_POST['password']), false);
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : $_POST['role'];
        $id = htmlentities($_POST['id_akun']) ? htmlspecialchars($_POST['id_akun']) : $_POST['id_akun'];

        $config = $this->konfig->update($nama,$username,$email,$password,$role,$id);
        if($config === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id = htmlentities($_GET['id_akun']) ? htmlspecialchars($_GET['id_akun']) : $_GET['id_akun'];

        $config = $this->konfig->delete($id);
        if($config === true){
            uniqid($id);
            return true;
        }else{
            return false;
        }
    }
}

class Barang {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Briefcase($konfig);
    }

    public function lihat(){
        $row = $this->konfig->read();
        return $row;
    }

    public function lihatstok(){
        $row = $this->konfig->minustok();
        return $row;
    }

    public function buat(){
        $nama = htmlentities($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : $_POST['nama_barang'];
        $kategori = htmlentities($_POST['id_kategori']) ? htmlspecialchars($_POST['id_kategori']) : $_POST['id_kategori'];
        $beli = htmlentities($_POST['harga_beli']) ? htmlspecialchars($_POST['harga_beli']) : $_POST['harga_beli'];
        $jual = htmlentities($_POST['harga_jual']) ? htmlspecialchars($_POST['harga_jual']) : $_POST['harga_jual'];
        $stok = htmlentities($_POST['jumlah_stok']) ? htmlspecialchars($_POST['jumlah_stok']) : $_POST['jumlah_stok'];
        $satuan = htmlentities($_POST['id_satuan']) ? htmlspecialchars($_POST['id_satuan']) : $_POST['id_satuan'];

        $config = $this->konfig->create($nama,$kategori,$beli,$jual,$stok,$satuan);
        if($config === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $nama = htmlentities($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : $_POST['nama_barang'];
        $kategori = htmlentities($_POST['id_kategori']) ? htmlspecialchars($_POST['id_kategori']) : $_POST['id_kategori'];
        $beli = htmlentities($_POST['harga_beli']) ? htmlspecialchars($_POST['harga_beli']) : $_POST['harga_beli'];
        $jual = htmlentities($_POST['harga_jual']) ? htmlspecialchars($_POST['harga_jual']) : $_POST['harga_jual'];
        $stok = htmlentities($_POST['jumlah_stok']) ? htmlspecialchars($_POST['jumlah_stok']) : $_POST['jumlah_stok'];
        $satuan = htmlentities($_POST['id_satuan']) ? htmlspecialchars($_POST['id_satuan']) : $_POST['id_satuan'];
        $id = htmlentities($_POST['id_barang']) ? htmlspecialchars($_POST['id_barang']) : $_POST['id_barang'];

        $config = $this->konfig->update($nama,$kategori,$beli,$jual,$stok,$satuan,$id);
        if($config === true){
            return true;
        }else{
            return false;
        }
    }

    public function stokbarang(){
        $stok = htmlentities($_POST['jumlah_stok']) ? htmlspecialchars($_POST['jumlah_stok']) : $_POST['jumlah_stok'];
        $id = htmlentities($_POST['id_barang']) ? htmlspecialchars($_POST['id_barang']) : $_POST['id_barang'];
        
        $config = $this->konfig->restok($stok,$id);
        if($config === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id = htmlentities($_GET['id_barang']) ? htmlspecialchars($_GET['id_barang']) : $_GET['id_barang'];
        $config = $this->konfig->delete($id);
        if($config === true){
            uniqid($id);
            return true;
        }else{
            return false;
        }
    }
}

class Kategori {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Category($konfig);
    }

    public function lihat(){
        $row = $this->konfig->read();
        return $row;
    }

    public function buat(){
        $nama = htmlentities($_POST['nama_kategori']) ? htmlspecialchars($_POST['nama_kategori']) : $_POST['nama_kategori'];

        $config = $this->konfig->create($nama);
        if($config === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $nama = htmlentities($_POST['nama_kategori']) ? htmlspecialchars($_POST['nama_kategori']) : $_POST['nama_kategori'];
        $id = htmlentities($_POST['id_kategori']) ? htmlspecialchars($_POST['id_kategori']) : $_POST['id_kategori'];

        $config = $this->konfig->update($nama,$id);
        if($config === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id = htmlentities($_GET['id_kategori']) ? htmlspecialchars($_GET['id_kategori']) : $_GET['id_kategori'];
        $config = $this->konfig->delete($id);
        if($config === true){
            uniqid($id);
            return true;
        }else{
            return false;
        }
    }
}

class Satuan {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Unit($konfig);
    }

    public function lihat(){
        $row = $this->konfig->read();
        return $row;
    }

    public function buat(){
        $nama = htmlentities($_POST['nama_satuan']) ? htmlspecialchars($_POST['nama_satuan']) : $_POST['nama_satuan'];

        $config = $this->konfig->create($nama);
        if($config === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $nama = htmlentities($_POST['nama_satuan']) ? htmlspecialchars($_POST['nama_satuan']) : $_POST['nama_satuan'];
        $id = htmlentities($_POST['id_satuan']) ? htmlspecialchars($_POST['id_satuan']) : $_POST['id_satuan'];

        $config = $this->konfig->update($nama,$id);
        if($config === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id = htmlentities($_GET['id_satuan']) ? htmlspecialchars($_GET['id_satuan']) : $_GET['id_satuan'];
        $config = $this->konfig->delete($id);
        if($config === true){
            uniqid($id);
            return true;
        }else{
            return false;
        }
    }
}

class Cashier {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Penjualan($konfig);
    }

    public function lihat(){
        $hasil = $this->konfig->read();
        return $hasil;
    }

    public function sum(){
        $hasil = $this->konfig->jumlah();
        return $hasil;
    }
    
    public function sum_nota(){
        $hasil = $this->konfig->jumlah_nota();
        return $hasil;
    }

    public function sum_penjualan(){
        $hasil = $this->konfig->total();
        return $hasil;
    }

    public function sum_penjualan_nota(){
        $hasil = $this->konfig->total_nota();
        return $hasil;
    }

    public function list_keranjang(){
        $id = htmlspecialchars($_GET['id_barang']);
        $hasil = $this->konfig->keranjang($id);
        
        if($hasil === true){
            return true;
        }else{
            return false;
        }
    }

    public function edit_keranjang(){
        $id = htmlentities($_POST['id_penjualan']);
        $id_barang = htmlentities($_POST['id_barang']);
        $jumlah = htmlentities($_POST['jumlah']);
        $hasil = $this->konfig->edit($jumlah,$id_barang,$id);
        
        if($hasil === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapusitem(){
        $barang = htmlentities($_GET['id_barang']) ? htmlspecialchars($_GET['id_barang']) : $_GET['id_barang'];
        $id = htmlentities($_GET['id_penjualan']) ? htmlspecialchars($_GET['id_penjualan']) : $_GET['id_penjualan'];
        $konfigs = $this->konfig->HapusItemKeranjang($barang,$id);
        if($konfigs){
            return true;
        }else{
            return false;
        }
    }

    public function ResetKeranjang(){
        $konfigs = $this->konfig->HapusResetKeranjang();
        if($konfigs){
            return true;
        }else{
            return false;
        }
    }
    
    public function ResetBelanja(){
        $konfigs = $this->konfig->HapusBelanjaan();
        if($konfigs){
            return true;
        }else{
            return false;
        }
    }
}

class pengaturan {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new setting($konfig);
    }

    public function ubah(){
        $ntoko = htmlentities($_POST['nama_toko']) ? htmlspecialchars($_POST['nama_toko']) : $_POST['nama_toko'];
        $npemilik = htmlentities($_POST['nama_pemilik']) ? htmlspecialchars($_POST['nama_pemilik']) : $_POST['nama_pemilik'];
        $flags = htmlentities($_POST['flags']) ? htmlspecialchars($_POST['flags']) : $_POST['flags'];
        $id = htmlentities($_POST['id_sistem']) ? htmlspecialchars($_POST['id_sistem']) : $_POST['id_sistem'];
        $nlogo = htmlentities($_FILES["logo"]["name"]) ? htmlspecialchars($_FILES["logo"]["name"]) : $_FILES["logo"]["name"];

        $row = $this->konfig->updatemart($ntoko, $npemilik, $nlogo, $flags, $id);
        if($row === true){
            return true;
        }else{
            return false;
        }
    }
}

?>