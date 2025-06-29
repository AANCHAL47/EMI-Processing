<?php

namespace App\Http\Controllers;

use App\Services\EmiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EmiController extends Controller
{

    protected $emiService;
    public function __construct(EmiService $emiService)
    {
        $this->emiService = $emiService;
    }

    public function process()
    {
        $this->emiService->processEmi();
        return redirect()->route('emi.index')->with('success', 'EMI data processed');
    }

    public function show()
    {
        $columns = [];
        $data = [];

        if (Schema::hasTable('emi_details')) {
            $columns = Schema::getColumnListing('emi_details');
            $columns = array_filter($columns, fn($col) => !in_array($col, ['id', 'clientid', 'created_at', 'updated_at']));
            $data = DB::table('emi_details')->get();
        }
        return view('emi.index', compact('columns', 'data'));
    }

}
