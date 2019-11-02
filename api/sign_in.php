<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: Content-Type");

require('../db.php');
$db = get_database();

// get username and password
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = password_hash($data['password']);

$stmt = $db->prepare("SELECT (id, password) FROM \"public.user\" WHERE username=:username;");
$stmt = $db->bindValue(":username", $username)
$result = $stmt->execute();

if ($result) {
    $row = $stmt->fetch();
    $passwordMatch = $row['password'];

    if (password_verify($password, $passwordMatch)) {
        echo $new_id;
    } else {
        http_response_code(401);
    }
} else {
    http_response_code(401);
}

?>
