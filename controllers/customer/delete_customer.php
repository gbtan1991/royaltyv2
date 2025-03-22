<?php 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Customer.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $customerModel = new Customer($pdo);

    if ($customerModel->deleteCustomer($id)) {
        header('Location: customer_view.php?success=Customer Deleted Successfully');
        exit;
    
    } else {
        header('Location: customer_view.php?error=Failed to Delete Customer');
        exit;
    }       

} else {
    // Handle the case when the id is not set
    header('Location: customer_view.php?error=Invalid Request');
    exit;
}




?>