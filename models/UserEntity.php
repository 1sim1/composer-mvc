<?php
namespace app\models;
use app\core\Database;
use Exception;
use PDO;
class UserEntity
{
    public $name;
    public $surname;
    public $email;
    public $password;
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function findAllUsers() {
        $qry = "SELECT * FROM USERS";
        $stmt = $this->conn->prepare($qry);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ); //con PDO::FETCH_OBJ ottengo un array di oggetti

        return $result;
    }
    public function findUserByEmail($email) {
        $qry = "SELECT * FROM USERS WHERE EMAIL = :email";
        $stmt = $this->conn->prepare($qry);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $user_found = $stmt->fetch(PDO::FETCH_OBJ);
        return $user_found;
    }
    public function addUser($name, $surname, $email, $password) {
        try {
            $this->conn->beginTransaction();
            $qry = "INSERT INTO USERS VALUES(:name, :surname, :email, :password)";
            $stmt = $this->conn->prepare($qry);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->execute();
            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo $e->getMessage();
            throw new Exception($e->getMessage());
        }
    }
    public function updateUser($new_name, $new_surname, $new_email, $new_user_name, $new_password, $old_user_name) {
        try {
            $this->conn->beginTransaction();
            $qry = "UPDATE USERS
                    SET name = :new_name, 
                        surname = :new_surname,
                        email = :new_email,
                        username = :new_user_name,
                        password = :new_password
                    WHERE username = :old_user_name;";
            $stmt = $this->conn->prepare($qry);
            $stmt->bindParam(":new_name", $new_name, PDO::PARAM_STR);
            $stmt->bindParam(":new_surname", $new_surname, PDO::PARAM_STR);
            $stmt->bindParam(":new_email", $new_email, PDO::PARAM_STR);
            $stmt->bindParam(":new_user_name", $new_user_name, PDO::PARAM_STR);
            $stmt->bindParam(":new_password", $new_password, PDO::PARAM_STR);
            $stmt->bindParam(":old_user_name", $old_user_name, PDO::PARAM_STR);
            $stmt->execute();
            $user_upd = $stmt->fetch(PDO::FETCH_OBJ);
            $this->conn->commit();
            return $user_upd;
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo $e->getMessage();
            throw new Exception($e->getMessage());
        }
    }
}
