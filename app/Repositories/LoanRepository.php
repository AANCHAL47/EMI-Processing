<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class LoanRepository
{
    public function getAllLoans() {
        return DB::table('loan_details')->get();
    }

    public function getMinStartDate() {
        return DB::table('loan_details')->min('first_payment_date');
    }

    public function getMaxEndDate() {
        return DB::table('loan_details')->max('last_payment_date');
    }

}
