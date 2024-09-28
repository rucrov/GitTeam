<?php
    require_once(__DIR__.'/../vendor/autoload.php');
    Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

    class Database {
        private $db_host;
        private $db_name;
        private $db_username;
        private $db_password;
        private $conn;

        public function __construct() {
            $this->db_host = getenv("DB_HOST");
            $this->db_name = getenv("DB_NAME");
            $this->db_username = getenv("DB_USER");
            $this->db_password = getenv("DB_PASSWORD");
        }

        public function connect() {
            $this->conn = null;
          
            try {
                $this->conn = new PDO("mysql:host={$this->db_host}; dbname={$this->db_name}", $this->db_username, $this->db_password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Connection Error: " . $e->getMessage();
                die();
            } 

            return $this->conn;
        }
    }
?>