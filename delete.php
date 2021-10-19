<?php

require_once('./bootstrap.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php?error=404');
    exit;
}

// Verifica se há um registro referente ao ID informado
$query = "SELECT * FROM employees WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();

$employee = $stmt->get_result()->fetch_object();

if (empty($employee)) {
    header('Location: index.php?error=404');
    exit;
}

$query = "DELETE FROM employees WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();

header('Location: index.php?success=s3');

