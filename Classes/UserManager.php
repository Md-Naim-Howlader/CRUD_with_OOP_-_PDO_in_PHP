<?php
 class UserManager  {
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getAllUser() {
        $sql   = "SELECT * FROM tbl_user ORDER BY id";
        $res   = $this->db->pdo->prepare($sql);
        $res->execute();
        $users = $res->fetchAll();

        if($users) {
            return $users;
        } else {
            return [];
        }
    }
    public function createNewUser($data) {
        $name     = $this->validate($data["name"]);
        $email = $this->validate($data["email"]);
        $skill    = $this->validate($data["skill"]);
        $chk_email = $this->emailExistCheck($email);

         if($name == "" || $email == "" || $skill == ""){
            return "<div class='alert alert-danger'><strong>Error! </strong>Field must not be Empty.</div>";
        }
        if(strlen($name) < 2){
            return "<div class='alert alert-danger'><strong>Error! </strong>Name must be atleast 2 characters.</div>";
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            return "<div class='alert alert-danger'><strong>Error! </strong> Invalid E-mail address.</div>";
        }

        if($chk_email) {
            return "<div class='alert alert-danger'><strong>Error! </strong>This Email ( $email ) already Registered.</div>";
        }

        // insert query
        $sql = "INSERT INTO tbl_user(name, email, skill) VALUES(:name, :email, :skill)";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(":name", $name);
        $query->bindValue(":email", $email);
        $query->bindValue(":skill", $skill);
        $res = $query->execute();

        if($res) {
            return "<div class='alert alert-success'><strong>Success! </strong>User added Successfully.</div>";
        } else {
            return "<div class='alert alert-danger'><strong>Error! </strong> Something went wrong.</div>";
        }
    }
    public function getUserById($id) {
        $sql = "SELECT * FROM tbl_user WHERE id=:id LIMIT 1";
        $res = $this->db->pdo->prepare($sql);
        $res->bindValue(":id", $id);
        $res->execute();
        $user = $res->fetchObject();

        if($user) {
            return $user;
        } else {
            header("Location: index.php");
            exit;
        }
    }

    public function updateUser($data, $id) {
        $name     = $this->validate($data["name"]);
        $email = $this->validate($data["email"]);
        $skill    = $this->validate($data["skill"]);

         if($name == "" || $email == "" || $skill == ""){
            return "<div class='alert alert-danger'><strong>Error! </strong>Field must not be Empty.</div>";
        }
        if(strlen($name) < 2){
            return "<div class='alert alert-danger'><strong>Error! </strong>Name must be atleast 2 characters.</div>";
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            return "<div class='alert alert-danger'><strong>Error! </strong> Invalid E-mail address.</div>";
        }
        // update query
        $sql = "UPDATE tbl_user SET name=:name, email=:email, skill=:skill  WHERE id=:id";
        $res = $this->db->pdo->prepare($sql);
        $res->bindValue(":name", $name);
        $res->bindValue(":email", $email);
        $res->bindValue(":skill", $skill);
        $res->bindValue(":id", $id);
        $result = $res->execute();

         if($result) {
            return "<div class='alert alert-success'><strong>Success! </strong>User Updated Successfully.</div>";
        } else {
            return "<div class='alert alert-danger'><strong>Error! </strong> User not Updated.</div>";
        }

    }
    public function deleteUser($id) {
        session_start();
        $sql = "DELETE FROM tbl_user WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $_SESSION['success'] = "<div class='alert alert-success'><strong>Success! </strong>User Deleted Successfully.</div>";
        } else {
            $_SESSION['error'] = "<div class='alert alert-danger'><strong>Error! </strong> User not Deleted.</div>";
        }
        header("location: index.php");
        exit();
    }

    // Helper Functions
     public function validate($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
    }
    public function emailExistCheck($email) {
        $sql = "SELECT email FROM tbl_user WHERE email=:email";
        $res = $this->db->pdo->prepare($sql);
        $res->bindValue(":email", $email);
        $res->execute();

        if($res->rowCount() > 0){
            return true;
        } else {
            return false;
        }

    }










}



?>