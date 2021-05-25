<?php

namespace App\Policies;

// use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class EmployeePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // products
    public function see_product()
    {
        if(in_array(Auth::user()->employee_type_id, [1]))
            return true;
        else 
            return false;
    }

    public function edit_product()
    {
        if(in_array(Auth::user()->employee_type_id, [1]))
            return true;
        else 
            return false;
    }

    // users
    public function see_users()
    {
        if(in_array(Auth::user()->employee_type_id, [1]))
            return true;
        else 
            return false;
    }

    public function alter_users()
    {
        if(Auth::user()->employee_type_id == 1)
            return true;
        else 
            return false;
    }

    // baskets
    public function see_baskets()
    {
        if(in_array(Auth::user()->employee_type_id, [1]))
            return true;
        else 
            return false;
    }

    // employees
    public function anything_employees()
    {
        if(in_array(Auth::user()->employee_type_id, [1]))
            return true;
        else 
            return false;
    }

    // shipments
    public function anything_shipments()
    {
        if(in_array(Auth::user()->employee_type_id, [1, 2]))
            return true;
        else 
            return false;
    }
    
    // address
    public function anything_address()
    {
        if(in_array(Auth::user()->employee_type_id, [1]))
            return true;
        else 
            return false;
    }

    // report
    public function see_reports()
    {
        if(in_array(Auth::user()->employee_type_id, [1]))
            return true;
        else 
            return false;
    }
}
