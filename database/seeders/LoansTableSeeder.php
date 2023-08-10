<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loan;

class LoansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loanrecords =[
        ['member_number'=>'0043',
       'loan_type'=>'normal',
      'amount'=>'20000',
       'repayment_period'=>'12',
       'balance'=>'18000',
       'interest_rate'=>'13',
       'repayment_status'=>'active',
       'status'=>'1'],
       
       ['member_number'=>'0044',
       'loan_type'=>'normal',
       'amount'=>'30000',
       'repayment_period'=>'12',
       'balance'=>'25000',
       'interest_rate'=>'13',
       'repayment_status'=>'active',
       'status'=>'1']
        ];
        Loan::insert($loanrecords);

    }
}
