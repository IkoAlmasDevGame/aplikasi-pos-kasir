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
                $_COOKIE['cookies'] = $userInput;
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
}
?>