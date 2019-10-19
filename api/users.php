<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET');

require('../db.php');
$db = get_database();

$search_statement = $db->prepare('SELECT * FROM public.user');
$search_statement->execute();
$rows = $search_statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rows);
?>
