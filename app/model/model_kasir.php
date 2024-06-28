<?php 
namespace model;

class Penjualan {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function read(){
        $sql = "SELECT penjualan.* , barang.id_barang, barang.nama_barang, barang.harga_jual from penjualan 
        inner join barang on barang.id_barang = penjualan.id_barang ORDER BY id_penjualan ASC";
        $row = $this->db->prepare($sql);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function jumlah(){
        $sql = "SELECT SUM(total) as bayar FROM penjualan";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row->fetch();
        return $hasil;
    } 

    public function jumlah_nota(){
        $sql = "SELECT SUM(total) as bayar FROM nota";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function total(){
        $sql = "SELECT SUM(total) as total FROM v_penjualan";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function total_nota(){
        $sql = "SELECT SUM(total) as total FROM v_nota";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function keranjang($id){
        $id = htmlspecialchars($_GET['id_barang']);
        $barang = "SELECT * FROM barang WHERE id_barang = ?";
        $row = $this->db->prepare($barang);
        $row->execute(array($id));
        $tambah = $row->fetch();

        if($tambah['jumlah'] > 0){
            $table = "penjualan";
            $jumlah = 1;
            $harga = $row['harga_jual'];
            $total = $row['harga_jual'] * $jumlah;
            $tgl = date("j F Y, G:i");

            $sql = "INSERT INTO $table (id_barang,harga_jual,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)";
            $beli = $this->db->prepare($sql);
            $beli->execute(array($id,$harga,$jumlah,$total,$tgl));
            $list = $this->db->prepare("INSERT INTO v_penjualan (id_barang,harga_jual,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)");
            $list->execute(array($id,$harga,$jumlah,$total,$tgl));
            echo "<script>document.location.href = '../ui/header.php?page=cashier&nota=yes'</script>";
        }else{
            echo '<script>
            alert("Stok Barang Anda Telah Habis !");
            document.location.href = "../ui/header.php?page=cashier#keranjang";
            </script>';
            exit;
        }
    }

    public function edit($jumlah,$id_barang,$id){
        $table = "barang";
        $id = htmlentities($_POST['id_penjualan']);
        $id_barang = htmlentities($_POST['id_barang']);
        $jumlah = htmlentities($_POST['jumlah']);

        $barang = "SELECT * FROM $table WHERE id_barang = ?";
        $rwbarang = $this->db->prepare($barang);
        $rwbarang->execute(array($id_barang));
        $hasil = $rwbarang->fetch();

        if($hasil['jumlah'] > $jumlah){
            $jual = $hasil['harga_jual'];
            $total = $jual * $jumlah;
            $data[] = $id;
            $data[] = $jumlah;
            $data[] = $total;
            
            $sqUpdate = "UPDATE penjualan SET jumlah=?, total=? WHERE id_penjualan=?";
            $rwUpdate = $this->db->prepare($sqUpdate);
            $rwUpdate->execute($data);
            $this->db->prepare("UPDATE v_penjualan SET jumlah=?, total=? WHERE id_penjualan=?")->execute($data);
            echo "<script>document.location.href = '../ui/header.php?page=cashier&nota=yes'</script>";
        }else{
            echo '<script>
            alert("Stok Barang Anda Telah Habis !");
            document.location.href = "../ui/header.php?page=cashier#keranjang";
            </script>';
            exit;
        }
    }

    public function HapusResetKeranjang(){
        $sqKeranjang = "DELETE FROM penjualan";
        $rwKeranjang = $this->db->prepare($sqKeranjang);
        $rwKeranjang->execute();
        echo "<script>document.location.href = '../ui/header.php?page=cashier'</script>";
    }
    
    public function HapusBelanjaan(){
        $sqBelanja = "DELETE FROM nota";
        $rwBelanja = $this->db->prepare($sqBelanja);
        $rwBelanja->execute();
        echo "<script>document.location.href = '../ui/header.php?page=cashier'</script>";
    }
    
    public function HapusItemKeranjang($barang,$id){
        $barang = htmlentities($_GET['id_barang']) ? htmlspecialchars($_GET['id_barang']) : $_GET['id_barang'];
        $id = htmlentities($_GET['id_penjualan']) ? htmlspecialchars($_GET['id_penjualan']) : $_GET['id_penjualan'];
        $sqBarang = "SELECT * from barang where id_barang = ?";
        $rwBarang = $this->db->prepapre($sqBarang);
        $rwBarang->execute(array($barang));

        $sqPenjualan = "DELETE FROM penjualan WHERE id_penjualan = ?";
        $rwPenjualan = $this->db->prepare($sqPenjualan);
        $rwPenjualan->execute(array($id));
        echo "<script>document.location.href = '../ui/header.php?page=cashier'</script>";
    }
}
?>