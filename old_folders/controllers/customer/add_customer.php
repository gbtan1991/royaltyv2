<?php
require_once __DIR__ . "/../../models/Customer.php";
require_once __DIR__ . "/../../config/database.php";

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? '';
    $fullname = $_POST["fullname"] ?? '';
    $gender = $_POST['gender'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';

    // Basic validation
    if (!$username || !$fullname || !$gender || !$birthdate) {
        header("Location: index.php?page=add_customer&error=Please fill in all required fields");
        exit;
    }

    if (!$pdo) {
        die("Database connection not initialized.");
    }

    $customerModel = new Customer($pdo);

    try {
        $existingCustomer = $customerModel->getCustomerByUsername($username);

        if ($existingCustomer) {
            header("Location: index.php?page=add_customer&error=Username already exists");
            exit;
        }

        $success = $customerModel->addCustomer($username, $fullname, $gender, $birthdate);

        if ($success) {
            header("Location: index.php?page=customer_view&success=Customer added successfully");
            exit;
        } else {
            header("Location: index.php?page=add_customer&error=Customer could not be added");
            exit;
        }
    } catch (Exception $e) {
        die("An unexpected error occurred: " . $e->getMessage());
    }

} else {
    // Not a POST request - redirect to add_customer form
    header("Location: index.php?page=add_customer");
    exit;
}
