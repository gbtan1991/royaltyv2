<?php 
require_once __DIR__ . "/../../models/Customer.php";
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];

    $customerModel = new Customer($pdo);

    try{
        $existingCustomer = $customerModel->getCustomerByUsername($username);
        if($existingCustomer){
            header("Location: ../../views/customer/add_customer.php?error=Username_exists");
            exit;
        }
    } catch (Exception $e) {
    
    }

    $success = $customerModel->addCustomer($username, $fullname);
    if($success){
        header("Location: ../../views/customer/add_customer.php?success=Customer_added");
        exit;
    } else {
        header("Location: ../../views/customer/add_customer.php?error=Customer_not_added");
        exit;
    }
}

?>