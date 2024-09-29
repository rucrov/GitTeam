<?php 
    class RestrictedBranches {
        private $conn;
        private $table = 'restricted_branches';

        public $restricted_id; 
        public $user_id; 
        public $branch_id; 

        public function __construct($db) {
            $this->conn = $db;
        }

        // public function getAllRestrictedBranches() {
        //     $query = "SELECT projects.project_url, branches.branch_name FROM {$this->table} INNER JOIN branches ON {$this->table}.branch_id = branches.branch_id INNER JOIN projects ON {$this->table}.project_id = projects.project_id WHERE user_id = (SELECT user_id FROM `users` WHERE nickname = ? AND email = ?)";

        //     $stmt = $this->conn->prepare($query);
        //     $stmt->execute();
        //     $arr = array();
        //     while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //         extract($row);
        //         array_push($arr, array("project_url" => $project_url, "branch_name" => $branch_name));
        //     }
        //     return $arr; 
        // }

        public function getRestrictedBranches($nickname, $email) {
            $query = "SELECT projects.project_url, branches.branch_name FROM {$this->table} INNER JOIN branches ON {$this->table}.branch_id = branches.branch_id INNER JOIN projects ON {$this->table}.project_id = projects.project_id WHERE user_id = (SELECT user_id FROM `users` WHERE nickname = ? AND email = ?)";

            $stmt = $this->conn->prepare($query);
            $stmt -> bindParam(1, $nickname);
            $stmt -> bindParam(2, $email);
            $stmt->execute();
            $arr = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                array_push($arr, array("project_url" => $project_url, "branch_name" => $branch_name));
            }
            return $arr; 
        }

        public function isRestrictedBranch($nickname, $email, $project_url, $branch_name) {
            $query = "SELECT projects.project_url, branches.branch_name FROM {$this->table} INNER JOIN branches ON {$this->table}.branch_id = branches.branch_id INNER JOIN projects ON {$this->table}.project_id = projects.project_id WHERE user_id = (SELECT user_id FROM `users` WHERE nickname = ? AND email = ?) AND projects.project_url = ? and branches.branch_name = ?";

            $stmt = $this->conn->prepare($query);
            $stmt -> bindParam(1, $nickname);
            $stmt -> bindParam(2, $email);
            $stmt -> bindParam(3, $project_url);
            $stmt -> bindParam(4, $branch_name);
            $stmt->execute();

            if ($stmt -> rowCount() == 1) {
                return true;
            }
            else {
                return false;
            }
        }
    }
?>