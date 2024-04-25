<?php
require("connect.php");

function chargerClass($classname) {
    require $classname . '.php';
}
spl_autoload_register("chargerClass");
session_start();
$conn = new PDO("mysql:host=localhost;dbname=db_blog", 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
if (isset($_POST['cree'])) {
    $data = array(
        
        'email' => $_POST['email'],
        'password' => $_POST['password']
    );

    $user = new User($data);
    $users = new Users($conn);
    $users->insererUser($user);
}
class User {
   
    private $email;
    private $password;
 

    public function __construct(array $user)
    {
        $this->hydrate($user);
    }

    public function hydrate(array $user)
    {
        foreach ($user as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }


    public function getPassword() {
        return $this->password;
    }

    public function setPassword($value) {
        $this->password = $value;
    } 

}

class Users {

    private $conn;

    public function __construct(PDO $conn) 
    { 
        $this->conn = $conn;
    }

    public function insererUser(User $user) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO login (email, Password) 
                 VALUES (:email, :password)");
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->execute();

        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>
