<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Customer.php';
require_once __DIR__ . '/../../config/session.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: customer_view.php?error=Missing customer ID');
    exit;
}

$customerModel = new Customer($pdo);
$customer = $customerModel->getCustomerById($_GET['id']);

if (!$customer) {
    header('Location: customer_view.php?error=Customer not found');
    exit;
}

// Load the edit form
require_once __DIR__ . '/../../views/customer/edit_customer.php';
