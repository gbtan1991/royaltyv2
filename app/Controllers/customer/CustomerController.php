<?php

namespace App\Controllers\customer;

use App\Models\Customer;

class CustomerController {

   public function index() {
    $customers = Customer::getAll();
    
    require __DIR__ . '/../../../views/customer/index.php';

   }

   
}
