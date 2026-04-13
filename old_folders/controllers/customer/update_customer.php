<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Customer.php';
require_once __DIR__ . '/../../config/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?page=customer_view&error=Invalid request');
    exit;
}

$id = $_POST['id'];
$username = $_POST['username'];
$fullname = $_POST['fullname'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];

$customerModel = new Customer($pdo);

try {
    $existingCustomer = $customerModel->getCustomerById($id);

    if (!$existingCustomer) {
        header('Location: index.php?page=customer_view&error=Customer not found');
        exit;
    }

    $success = $customerModel->updateCustomer($id, $username, $fullname, $gender, $birthdate);

    if ($success) {
        header('Location: index.php?page=customer_view&success=Customer updated successfully');
        exit;
    } else {
        header('Location: index.php?page=customer_edit&id=' . $id . '&error=Failed to update customer');
        exit;
    }
} catch (Exception $e) {
    header('Location: index.php?page=customer_edit&id=' . $id . '&error=' . urlencode($e->getMessage()));
    exit;
}
