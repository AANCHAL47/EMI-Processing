<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    
    public function index() 
    {
        $loans = LoanDetail::all();
        return view('loan.index', compact('loans'));
    }

}
