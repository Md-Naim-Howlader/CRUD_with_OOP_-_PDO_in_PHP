<?php

 class Database  {

    private $db_host     = DB_HOST;
    private $db_user     = DB_USER;
    private $db_password = DB_PASS;
    private $db_name    = DB_NAME;
    public  $pdo;



    public function __construct() {

        if(!isset($this->pdo)) {
            try {
                  $link = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name,$this->db_user, $this->db_password);

                    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $link->exec("SET CHARACTER SET utf8");
                    $this->pdo = $link;


            } catch (PDOException $err) {
                die("Faild to connect with Database: ".$err->getMessage());

            }
        }
    }
}



?>