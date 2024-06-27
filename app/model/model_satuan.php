<?php 
namespace model;

class Unit {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function read(){
        $sql = "SELECT * FROM satuan order by id_satuan asc";
        $row = $this->db->query($sql);
        return $row;
    }

    public function create($nama){
        $nama = htmlentities($_POST['nama_satuan']) ? htmlspecialchars($_POST['nama_satuan']) : $_POST['nama_satuan'];

        $table = "satuan";
        $sql = "INSERT INTO $table (id_satuan, nama_satuan) VALUES ('', '$nama')";
        $config = $this->db->query($sql);

        if($config){
            echo "<script>
            document.location.href = '../ui/header.php?page=satuan&info=berhasil'
            </script>";
            exit;
        }else{
            echo "<script>
            document.location.href = '../ui/header.php?page=satuan&info=gagal'
            </script>";
            exit;
        }
    }

    public function update($nama, $id){
        $nama = htmlentities($_POST['nama_satuan']) ? htmlspecialchars($_POST['nama_satuan']) : $_POST['nama_satuan'];
        $id = htmlentities($_POST['id_satuan']) ? htmlspecialchars($_POST['id_satuan']) : $_POST['id_satuan'];

        $table = "satuan";
        $sql = "UPDATE $table SET nama_satuan='$nama' WHERE id_satuan='$id'";
        $config = $this->db->query($sql);

        if($config){
            echo "<script>
            document.location.href = '../ui/header.php?page=satuan&info=ubah'
            </script>";
            exit;
        }else{
            echo "<script>
            document.location.href = '../ui/header.php?page=satuan&info=gagal'
            </script>";
            exit;
        }
    }

    public function delete($id){
        $id = htmlentities($_GET['id_satuan']) ? htmlspecialchars($_GET['id_satuan']) : $_GET['id_satuan'];

        $table = "satuan";
        $sql = "DELETE FROM $table WHERE id_satuan = '$id'";
        $config = $this->db->query($sql);

        if($config){
            echo "<script>
            document.location.href = '../ui/header.php?page=satuan&info=hapus'
            </script>";
            exit;
        }else{
            echo "<script>
            document.location.href = '../ui/header.php?page=satuan&info=gagal'
            </script>";
            exit;
        }
    }
}
?>