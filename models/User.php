<?php
    class User {
        private $conn;
        private $table = 'users';

        public $user_id;
        public $name;
        public $nickname;
        public $email;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getAllUsers() {
            $query = 'SELECT user_id, name, nickname, email FROM ' . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $arr = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                array_push($arr, array('user_id' => $user_id, 'name' => $name, 'nickname' => $nickname, 'email' => $email));
            }
            return $arr;
        }

        public function getUserId($nickname, $email) {
            $query = "SELECT user_id FROM " . $this->table . " WHERE nickname = ? AND email = ?";

            $stmt = $this->conn->prepare($query);
            $stmt -> bindParam(1, $nickname);
            $stmt -> bindParam(2, $email);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['user_id'];
        }
    }
?>