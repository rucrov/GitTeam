<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/RestrictedBranches.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);

        if (isset($data["nickname"], $data["email"], $data["project_name"], $data["branch_name"])) {    
            $database = new Database();
            $db = $database->connect();
            $restrictedBranches = new RestrictedBranches($db);
            $result = $restrictedBranches -> isRestrictedBranch($data["nickname"], $data["email"], $data["project_name"], $data["branch_name"]);
            echo json_encode($result);
        } else {
            http_response_code(400);
            echo json_encode(array("error" => 400, "message" => "Required parameters are missing! (nickname, email, project_name, branch_name)"));
        }
    }
    else {
        http_response_code(405);
    }
?>