<?php 
namespace model;

class Pengguna {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function login($userInput, $password){
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : $_POST['userInput'];
        $password = md5($_POST['password'],  false);
        password_verify($password, PASSWORD_DEFAULT);

        $table = "user";
        $sql = "SELECT * FROM $table WHERE username='$userInput' and password='$password' || email='$userInput' and password='$password'";
        $config = $this->db->query($sql);
        $cek = mysqli_num_rows($config);

        if($cek > 0){
            $response = array($userInput,$password);
            $response['user'] = array($userInput, $password);
            if($row = $config->fetch_assoc()){
                if($row['role'] == "admin"){
                    $_SESSION['id_akun'] = $row['id_akun'];
                    $_SESSION['nama'] = $row['nama_pengguna'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role'] = "admin";
                    echo "<script>
                    document.location.href = '../ui/header.php?page=beranda&info=success';
                    </script>";
                }elseif($row['role'] == "cashier"){
                    $_SESSION['id_akun'] = $row['id_akun'];
                    $_SESSION['nama'] = $row['nama_pengguna'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role'] = "cashier";
                    echo "<script>
                    document.location.href = '../ui/header.php?page=beranda&info=success';
                    </script>";
                }
                $_SESSION['status'] = true;
                $_COOKIE['cookies'] = $userInput; // input username atau email
                setcookie($response['user'], $row, time() + (86400 * 30), "/"); // penambahan timer ketika waktu sudah melewati 1 hari
                array_push($response['user'], $row);
                exit;
            }
        }else{
            $_SESSION['status'] = false;
            echo "<script>
            document.location.href = '../auth/login.php?info=gagal';
            </script>";
            die;
            exit;
        }
    }

    public function create($nama,$username,$email,$password,$role){
        $nama = htmlentities($_POST['nama_pengguna']) ? htmlspecialchars($_POST['nama_pengguna']) : $_POST['nama_pengguna'];
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : $_POST['username'];
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : $_POST['email'];
        $password = md5(htmlspecialchars($_POST['password']), false);
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : $_POST['role'];

        $table = "user";
        
        if($role == "admin"){
            $sql = "INSERT INTO $table (id_akun,nama_pengguna,username,email,password,role)
             VALUES ('','$nama','$username','$email','$password','$role')";
            $config = $this->db->query($sql);
        }elseif($role == "cashier"){
            $sql = "INSERT INTO $table (id_akun,nama_pengguna,username,email,password,role)
             VALUES ('','$nama','$username','$email','$password','$role')";
            $config = $this->db->query($sql);
        }

        if($config){
            echo "<script>
            document.location.href='../ui/header.php?page=pengguna&info=berhasil'
            </script>";
            exit;
        }else{
            echo "<script>
            document.location.href='../ui/header.php?page=pengguna&info=gagal'
            </script>";
            exit;
        }
    }

    public function update($nama,$username,$email,$password,$role,$id){
        $nama = htmlentities($_POST['nama_pengguna']) ? htmlspecialchars($_POST['nama_pengguna']) : $_POST['nama_pengguna'];
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : $_POST['username'];
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : $_POST['email'];
        $password = md5(htmlspecialchars($_POST['password']), false);
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : $_POST['role'];
        $id = htmlentities($_POST['id_akun']) ? htmlspecialchars($_POST['id_akun']) : $_POST['id_akun'];

        $table = "user";
        
        if($role == "admin"){
            $sql = "UPDATE $table SET nama_pengguna='$nama', username='$username', email='$email', password='$password', role='$role' WHERE id_akun = '$id'";
            $config = $this->db->query($sql);
            if($config){
                echo "<script>
                document.location.href='../ui/header.php?page=pengguna&info=ubah'
                </script>";
                exit;
            }else{
                echo "<script>
                document.location.href='../ui/header.php?page=pengguna&aksi=ubahpengguna&id_akun=$_GET[id_akun]'
                </script>";
                exit;                
            }
        }elseif($role == "cashier"){
            $sql = "UPDATE $table SET nama_pengguna='$nama', username='$username', email='$email', password='$password', role='$role' WHERE id_akun = '$id'";
            $config = $this->db->query($sql);
            if($config){
                echo "<script>
                document.location.href='../ui/header.php?page=beranda&info=updated'
                </script>";
                exit;
            }else{
                echo "<script>
                document.location.href='../ui/header.php?page=ubah-pengguna&id_akun=$_GET[id_akun]'
                </script>";
                exit;
            }
        }
    }

    public function delete($id){
        $id = htmlentities($_GET['id_akun']) ? htmlspecialchars($_GET['id_akun']) : $_GET['id_akun'];
        $table = "user";
        $sql = "DELETE FROM $table WHERE id_akun = '$id'";
        $config = $this->db->query($sql);

        if($config){
            echo "<script>
            document.location.href='../ui/header.php?page=pengguna&info=hapus'
            </script>";
            exit;
        }else{
            echo "<script>
            document.location.href='../ui/header.php?page=beranda'
            </script>";
            exit;
        }
    }
}
?>