<?php 
    class Branches {
        private $conn;
        private $table = 'branches';

        public $branch_id;
        public $branch_name;
        public $project_id;
        public $description;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getBranchByName($branch_id) {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE branch_name = ?';
            $stmt = $this->conn->prepare($query);
            $stmt -> bindParam(1, $branch_id);
            $stmt->execute();

            return $stmt;
        }

        public function getBranchsByIds(array $branch_ids) {
            //подготавливаем строку для того чтобы передать массив она заполена лишь ?, ?, ?, ?,
            $inQuery = str_repeat('?,', count($branch_ids) - 1) . '?';
            $query = 'SELECT * FROM ' . $this->table . ' WHERE  branch_id in ' . '(' . $inQuery . ')';
            $stmt = $this->conn->prepare($query);
            json_encode($inQuery);
            $stmt->execute($branch_ids);

            return $stmt;
        }
    }
?>