<?php 
namespace model;

class setting {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function updatemart($ntoko, $npemilik, $nlogo, $flags, $id){
        $ntoko = htmlentities($_POST['nama_toko']) ? htmlspecialchars($_POST['nama_toko']) : $_POST['nama_toko'];
        $npemilik = htmlentities($_POST['nama_pemilik']) ? htmlspecialchars($_POST['nama_pemilik']) : $_POST['nama_pemilik'];
        $flags = htmlentities($_POST['flags']) ? htmlspecialchars($_POST['flags']) : $_POST['flags'];
        $id = htmlentities($_POST['id_sistem']) ? htmlspecialchars($_POST['id_sistem']) : $_POST['id_sistem'];
        
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif'); 
        $nlogo = htmlentities($_FILES["logo"]["name"]) ? htmlspecialchars($_FILES["logo"]["name"]) : $_FILES["logo"]["name"];
        $x_foto = explode('.', $nlogo);
        $ekstensi_foto = strtolower(end($x_foto));
        $ukuran_foto = $_FILES['logo']['size'];
        $file_tmp_foto = $_FILES['logo']['tmp_name'];

        if(in_array($ekstensi_foto,$ekstensi_diperbolehkan_foto) === true){
            if($ukuran_foto < 10440070){
                move_uploaded_file($file_tmp_foto, "../../../assets/" . $nlogo);
                $sql = "UPDATE sistem SET nama_toko = '$ntoko', nama_pemilik = '$npemilik', logo = '$nlogo', flags = '$flags' WHERE id_sistem = '$id'"; 
                $row = $this->db->query($sql);
                if($row){
                    echo "<script>
                    document.location.href = '../ui/header.php?page=pengaturan&info=ubah';
                    </script>";
                    exit;
                }else{
                    echo "<script>
                    document.location.href = '../ui/header.php?page=pengaturan&aksi=ubahtoko&id_sistem=$_GET[id_sistem]';
                    </script>";                    
                    exit;
                }
            }else{
                echo "GAGAL MENGUPLOAD FILE FOTO";
            }        
        }else{
            echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
        }
    }
}
?>