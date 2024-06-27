<?php 
namespace model;

class Briefcase {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function read(){
        $sql = "SELECT barang.*, kategori.id_kategori, kategori.nama_kategori, satuan.id_satuan, satuan.nama_satuan FROM barang
         inner join kategori on barang.id_kategori = kategori.id_kategori inner join satuan on barang.id_satuan = satuan.id_satuan order by id_barang asc";
        $row = $this->db->query($sql);
        return $row;
    }

    public function minustok(){
        $sql = "SELECT barang.*, kategori.id_kategori, kategori.nama_kategori, satuan.id_satuan, satuan.nama_satuan FROM barang
         inner join kategori on barang.id_kategori = kategori.id_kategori inner join satuan on barang.id_satuan = satuan.id_satuan WHERE jumlah_stok <= 3 
         order by id_barang asc";
        $row = $this->db->query($sql);
        return $row;
    }

    public function create($nama,$kategori,$beli,$jual,$stok,$satuan){
        $nama = htmlentities($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : $_POST['nama_barang'];
        $kategori = htmlentities($_POST['id_kategori']) ? htmlspecialchars($_POST['id_kategori']) : $_POST['id_kategori'];
        $beli = htmlentities($_POST['harga_beli']) ? htmlspecialchars($_POST['harga_beli']) : $_POST['harga_beli'];
        $jual = htmlentities($_POST['harga_jual']) ? htmlspecialchars($_POST['harga_jual']) : $_POST['harga_jual'];
        $stok = htmlentities($_POST['jumlah_stok']) ? htmlspecialchars($_POST['jumlah_stok']) : $_POST['jumlah_stok'];
        $satuan = htmlentities($_POST['id_satuan']) ? htmlspecialchars($_POST['id_satuan']) : $_POST['id_satuan'];

        $table = "barang";
        $sql = "INSERT INTO $table (id_barang,nama_barang,id_kategori,harga_beli,harga_jual,jumlah_stok,id_satuan)
         VALUES ('','$nama','$kategori','$beli','$jual','$stok','$satuan')";
        $config = $this->db->query($sql);

        if($config){
            echo "<script>
            document.location.href = '../ui/header.php?page=barang&info=berhasil'
            </script>";
            exit;
        }else{
            echo "<script>
            document.location.href = '../ui/header.php?page=barang&info=gagal'
            </script>";
            exit;            
        }
    }

    public function update($nama,$kategori,$beli,$jual,$stok,$satuan,$id){
        $nama = htmlentities($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : $_POST['nama_barang'];
        $kategori = htmlentities($_POST['id_kategori']) ? htmlspecialchars($_POST['id_kategori']) : $_POST['id_kategori'];
        $beli = htmlentities($_POST['harga_beli']) ? htmlspecialchars($_POST['harga_beli']) : $_POST['harga_beli'];
        $jual = htmlentities($_POST['harga_jual']) ? htmlspecialchars($_POST['harga_jual']) : $_POST['harga_jual'];
        $stok = htmlentities($_POST['jumlah_stok']) ? htmlspecialchars($_POST['jumlah_stok']) : $_POST['jumlah_stok'];
        $satuan = htmlentities($_POST['id_satuan']) ? htmlspecialchars($_POST['id_satuan']) : $_POST['id_satuan'];
        $id = htmlentities($_POST['id_barang']) ? htmlspecialchars($_POST['id_barang']) : $_POST['id_barang'];

        $table = "barang";
        $sql = "UPDATE $table SET nama_barang='$nama', id_kategori='$kategori', harga_beli='$beli',
         harga_jual='$jual', jumlah_stok='$stok', id_satuan='$satuan' WHERE id_barang = '$id'";
        $config = $this->db->query($sql);

        if($config){
            echo "<script>
            document.location.href = '../ui/header.php?page=barang&info=ubah'
            </script>";
            exit;
        }else{
            echo "<script>
            document.location.href = '../ui/header.php?page=barang&info=gagal'
            </script>";
            exit;            
        }
    }

    public function restok($stok, $id){
        $stok = htmlentities($_POST['jumlah_stok']) ? htmlspecialchars($_POST['jumlah_stok']) : $_POST['jumlah_stok'];
        $id = htmlentities($_POST['id_barang']) ? htmlspecialchars($_POST['id_barang']) : $_POST['id_barang'];

        $table = "barang";
        $sql = "UPDATE $table SET jumlah_stok='$stok' WHERE id_barang = '$id'";
        $config = $this->db->query($sql);

        if($config){
            echo "<script>
            document.location.href = '../ui/header.php?page=barang&info=ubah'
            </script>";
            exit;
        }else{
            echo "<script>
            document.location.href = '../ui/header.php?page=barang&info=gagal'
            </script>";
            exit;            
        }
    }

    public function delete($id){
        $id = htmlentities($_GET['id_barang']) ? htmlspecialchars($_GET['id_barang']) : $_GET['id_barang'];
        
        $table = "barang";
        $sql = "DELETE FROM $table WHERE id_barang = '$id'";
        $config = $this->db->query($sql);

        if($config){
            echo "<script>
            document.location.href = '../ui/header.php?page=barang&info=hapus'
            </script>";
            exit;
        }else{
            echo "<script>
            document.location.href = '../ui/header.php?page=barang&info=gagal'
            </script>";
            exit;            
        }
    }
}

?>