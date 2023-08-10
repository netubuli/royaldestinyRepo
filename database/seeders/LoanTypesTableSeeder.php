<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoanType;

class LoanTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loantyperecords =[
            [
         'type'=>'normal',
         'repayment_period'=>'12',
         'interest_rate'=>'13',
           ],
           [
            'type'=>'emergency',
            'repayment_period'=>'12',
            'interest_rate'=>'13',
              ],
              [
                'type'=>'normal',
                'repayment_period'=>'24',
                'interest_rate'=>'13',
                  ],
              [
                'type'=>'msingi',
                'repayment_period'=>'12',
                'interest_rate'=>'12',
                  ]
            ];
            LoanType::insert($loantyperecords);
    }
}
