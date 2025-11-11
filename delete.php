<?php
require 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('DELETE FROM penyewa WHERE id = :id');
$stmt->execute([':id' => $id]);

header('Location: index.php');
exit;
?>
