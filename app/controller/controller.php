<?php 
namespace controller;
use model\Pengguna;
use model\Briefcase;
use model\Category;
use model\Unit;

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

?>