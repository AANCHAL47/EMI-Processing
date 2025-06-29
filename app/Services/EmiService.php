<?php

namespace App\Services;

use App\Repositories\LoanRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmiService
{
    protected $loanRepo;

    public function __construct(LoanRepository $loanRepo)
    {
        $this->loanRepo = $loanRepo;
    }

    public function processEmi()
    {
        // Drop old table
        DB::statement("DROP TABLE IF EXISTS emi_details");

        // Date range for dynamic columns
        $minDate = $this->loanRepo->getMinStartDate();
        $maxDate = $this->loanRepo->getMaxEndDate();

        $start = Carbon::parse($minDate);
        $end = Carbon::parse($maxDate);

        $columnArray = [];
        while ($start <= $end) {
            $columnArray[] = "`" . $start->format('Y_M') . "` DECIMAL(10,2) DEFAULT 0";
            $start->addMonth();
        }

        $columns = implode(',', $columnArray);

        DB::statement("CREATE TABLE emi_details (
            id INT AUTO_INCREMENT PRIMARY KEY,
            clientid BIGINT,
            $columns,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        )");

        // Insert EMI rows
        $loans = $this->loanRepo->getAllLoans();

        foreach ($loans as $loan) {
            $emiAmount = round($loan->loan_amount / $loan->num_of_payment, 2);
            $data = [];
            $date = Carbon::parse($loan->first_payment_date);

            for ($i = 1; $i <= $loan->num_of_payment; $i++) {
                $month = $date->format('Y_M');
                $data[$month] = isset($data[$month]) ? $data[$month] + $emiAmount : $emiAmount;
                $date->addMonth();
            }

            // Adjust EMI to match loan amount
            $total = array_sum($data);
            $diff = round($loan->loan_amount - $total, 2);
            if ($diff != 0) {
                $lastKey = array_key_last($data);
                $data[$lastKey] += $diff;
            }

            // Prepare SQL
            $columnList = "`clientid`, " . implode(',', array_map(fn($k) => "`$k`", array_keys($data))) . ", `created_at`, `updated_at`";
            $valueList = "$loan->clientid, " . implode(',', array_map(fn($v) => number_format($v, 2, '.', ''), $data)). ", NOW(), NOW()";

            DB::statement("INSERT INTO emi_details ($columnList) VALUES ($valueList)");
        }
    }

}
