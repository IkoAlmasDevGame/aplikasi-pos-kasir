<?php 
namespace model;

class Category {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function read(){
        $sql = "SELECT * FROM kategori order by id_kategori asc";
        $row = $this->db->query($sql);
        return $row;
    }

    public function create($nama){
        $nama = htmlentities($_POST['nama_kategori']) ? htmlspecialchars($_POST['nama_kategori']) : $_POST['nama_kategori'];
        
        $table = "kategori";
        $sql = "INSERT INTO $table (id_kategori,nama_kategori) VALUES ('','$nama')";
        $config = $this->db->query($sql);

        if($config){
            echo "<script>
            document.location.href = '../ui/header.php?page=kategori&info=berhasil'
            </script>";
            exit;
        }else{
            echo "<script>
            document.location.href = '../ui/header.php?page=kategori&info=gagal'
            </script>";
            exit;
        }
    }
    
    public function update($nama,$id){
        $nama = htmlentities($_POST['nama_kategori']) ? htmlspecialchars($_POST['nama_kategori']) : $_POST['nama_kategori'];
        $id = htmlentities($_POST['id_kategori']) ? htmlspecialchars($_POST['id_kategori']) : $_POST['id_kategori'];
        
        $table = "kategori";
        $sql = "UPDATE $table SET nama_kategori='$nama' WHERE id_kategori='$id'";
        $config = $this->db->query($sql);

        if($config){
            echo "<script>
            document.location.href = '../ui/header.php?page=kategori&info=ubah'
            </script>";
            exit;
        }else{
            echo "<script>
            document.location.href = '../ui/header.php?page=kategori&info=gagal'
            </script>";
            exit;
        }
    }

    public function delete($id){
        $id = htmlentities($_GET['id_kategori']) ? htmlspecialchars($_GET['id_kategori']) : $_GET['id_kategori'];
        
        $table = "kategori";
        $sql = "DELETE FROM $table WHERE id_kategori='$id'";
        $config = $this->db->query($sql);

        if($config){
            echo "<script>
            document.location.href = '../ui/header.php?page=kategori&info=hapus'
            </script>";
            exit;
        }else{
            echo "<script>
            document.location.href = '../ui/header.php?page=kategori&info=gagal'
            </script>";
            exit;            
        }
    }
}
?>