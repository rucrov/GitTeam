<?php
    class Projects {
        private $conn;
        private $table = 'projects';

        public $project_id ;
        public $project_url;
        public $description;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getProjectNameById($id) {
            $query = 'SELECT project_url FROM ' . $this->table . ' WHERE project_id = ?';
            $stmt = $this->conn->prepare($query);
            $stmt -> bindParam(1, $id);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['project_url'];
            }
            else {
                return null;
            }
        }

        // public function getProjectsByIds(array $project_ids) { 
        //     //подготавливаем строку для того чтобы передать массив она заполена лишь ?, ?, ?, ?,
        //     $inQuery = str_repeat('?,', count($project_ids) - 1) . '?';

        //     $query = 'SELECT project_url FROM ' . $this->table . ' WHERE project_id in '  . '(' . $inQuery . ')' . 'GROUP BY project_url';

        //     //подготовка запроса для всех баз данных 
        //     $stmt = $this->conn->prepare($query);

        //     //выполнение запроса
        //     $stmt->execute($project_ids);

        //     return $stmt;
        // }
    }
?>