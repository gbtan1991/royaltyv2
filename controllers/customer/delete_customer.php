<?php 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Customer.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $customerModel = new Customer($pdo);

    if ($customerModel->deleteCustomer($id)) {
        header('Location: index.php?page=customer_view&success=Customer Deleted Successfully');
        exit;
    
    } else {
        header('Location: index.php?page=customer_view&error=Failed to Delete Customer');
        exit;
    }       

} else {
    // Handle the case when the id is not set
    header('Location: index.php?page=customer_view&error=Invalid Request');
    exit;
}



