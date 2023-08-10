<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('123456');
        $adminRecords = [
            'id'=>3,'name'=>'Admin','type'=>'subadmin','mobile'=>'0728958261','email'=>'netubuli3@gmail.com','password'=>$password,'image'=>'','status'=>'1',
            'id'=>4,'name'=>'Admin','type'=>'subadmin','mobile'=>'07342324','email'=>'netubuli4@gmail.com','password'=>$password,'image'=>'','status'=>'1'
        ];
        Admin::insert($adminRecords);

    }
}