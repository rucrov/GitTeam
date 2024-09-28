<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $database = new Database();
        $db = $database->connect();
        $user = new User($db);
        $result = $user->getAllUsers();
        echo json_encode($result);
    }
    else {
        http_response_code(405);
    }
?>