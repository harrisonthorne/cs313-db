<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: Content-Type");

require('../user.php');
require('../db.php');
$db = get_database();

// get username and password
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

$stmt = $db->prepare('SELECT id, keycode, password FROM "public.user" WHERE username = :username;');
$stmt->bindValue(":username", $username);
$result = $stmt->execute();

if ($result) {
    $row = $stmt->fetch();
    $passwordMatch = $row['password'];
    $passwordMatch = substr($passwordMatch, 0, 60);
    $id = $row['id'];
    $keycode = $row['keycode'];

    if (password_verify($password, $passwordMatch)) {
        $user = new User($id, $keycode);
        echo json_encode($user->expose());
    } else {
        http_response_code(401);
    }
} else {
    http_response_code(500);
}

?>
