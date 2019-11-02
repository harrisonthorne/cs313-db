<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: Content-Type");

require('../db.php');
$db = get_database();

function get_random_hex($num_bytes=8) {
    return bin2hex(openssl_random_pseudo_bytes($num_bytes));
}

$keycode = get_random_hex(4);

// get username and password
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = password_hash($data['password']);

$search_statement = $db->prepare("INSERT INTO \"public.user\" (id, keycode, username, password) VALUES (nextval('uuid_seq'), '$keycode', '$username', '$password');");
$search_statement->execute();
$new_id = $db->lastInsertId();

echo $new_id;
?>
