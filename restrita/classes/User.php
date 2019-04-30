<?php
    
session_start();

require_once('../classes/Sql.php');

class User
{
    private $idusuario;
    private $email;
    private $password;
    private $name;
    private $dtcadastro;

    const SESSION = "user";

    public function __construct($email = "", $password = "")
    {
        $this->setEmail($email);
        $this->setPassword($password);
    }

    public function getIdusuario()
    {
        return $this->idusuario;
    }

    public function setIdusuario($value)
    {
        $this->idusuario = $value;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($value)
    {
        $this->name = $value;
    }


    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }

    public function setDtcadastro($value)
    {
        $this->dtcadastro = $value;
    }

    public function checkLogin()
    {
        if (
            !isset($_SESSION[User::SESSION])
            ||
            !$_SESSION[User::SESSION]
            ||
            !(int)$_SESSION[User::SESSION]["idusuario"] > 0
        ) {
            header("Location: ../");
        } else {
            return true;
        }
    }

    public function login($login, $password)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE email = :LOGIN", array(
            ":LOGIN" => $login,
        ));
        if (count($results) > 0) {
            if (User::decrypt($results[0]["password"]) === $password){
    
                $this->setData($results[0]);

                $_SESSION[User::SESSION] = $results[0];
                
                return true;
    
            } else {
    
                throw new \Exception("Usuário inexistente ou senha inválida");
    
            }
        } else {
            throw new Exception("Login e/ou senha inválidos.");
        }
    }

    public function setData($data)
    {
        $this->setIdusuario($data['idusuario']);
        $this->setEmail($data['email']);
        $this->setPassword($data['password']);
        $this->setName($data['name']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    public function insert($name, $email, $password)
    {
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE email = :LOGIN", array(
            ":LOGIN" => $email,
        ));
        if (count($results) > 0) {
            throw new Exception("Email já cadastrado");
        } else {
            $sql->query("INSERT INTO tb_usuarios (name, email, password) 
                        VALUES (:name, :email, :password)", array(
                ":name" => $name,
                ":email" => $email,
                ":password" => User::encrypt($password),
            ));
        }
    }

    public static function encrypt($string)
    {
        $output         = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key     = 'S3CRET_K3Y';
        $secret_iv      = 'S3CR3T_1V';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    public static function decrypt($string)
    {
        $output         = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key     = 'S3CRET_K3Y';
        $secret_iv      = 'S3CR3T_1V';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }

    public static function logout(){
        session_unset($_SESSION[User::SESSION]);
        session_destroy();
        header('Location: ../login');
    }
}
