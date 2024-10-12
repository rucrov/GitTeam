<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include_once '../../config/Database.php';
        include_once '../../models/RestrictedBranches.php';

        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);

        if (isset($data["nickname"], $data["email"])) {    
            $database = new Database();
            $db = $database->connect();
            $restrictedBranches = new RestrictedBranches($db);
            $result = $restrictedBranches -> getRestrictedBranches($data["nickname"], $data["email"]);
            echo json_encode($result);
        } else {
            http_response_code(400);
            echo json_encode(array("error" => 400, "message" => "Required parameters are missing! (nickname, email)"));
        }
    }
    else {
        http_response_code(405);
    }
?>