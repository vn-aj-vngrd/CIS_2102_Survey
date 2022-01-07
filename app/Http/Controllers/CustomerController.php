<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function validateCustomer(Request $request)
    {
        $validate = Customer::firstWhere('active', 1);
    }
}
