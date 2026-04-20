<?php

namespace App\Controllers\customer;

use App\Models\Customer;

class CustomerController {

   public function index() {
    $customers = Customer::getAll();
    
    require __DIR__ . '/../../../views/customer/index.php';

   }

   public function create() {
      require __DIR__ . '/../../../views/customer/create.php';
   }
 
   
   public function store() {
    if (Customer::store($_POST)) {
        header('Location: /royaltyv2/public/customer');
        exit();
    } else {
        echo "Failed to create customer. Username or Email might already be taken.";
    } 


   }
}
