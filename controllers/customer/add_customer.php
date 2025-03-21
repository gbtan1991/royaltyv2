<?php 
require_once __DIR__ . "/../../models/Customer.php";
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];

    $customerModel = new Customer($pdo);

    try{
        $existingCustomer = $customerModel->getCustomerByUsername($username);
        if($existingCustomer){
            header("Location: ../../views/customer/add_customer.php?error=Username exists");
            exit;
        }
    } catch (Exception $e) {
    
    }

    $success = $customerModel->addCustomer($username, $fullname, $gender, $birthdate);
    if($success){
        header("Location: customer_view.php?success=Customer added successfully");
 exit;
    } else {
        header("Location: customer_view.php?error=Customer not added");
        exit;
    }
}

?>