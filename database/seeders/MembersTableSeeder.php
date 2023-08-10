<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;
use Hash;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('123456');
        $memberrecords =[
            [
            'name'=>'Dan omulama',
            'mobile'=>'0705623820',
            'nationality'=>'Kenyan',
            'id_passport_number'=>'26332023',
            'county_city'=>'Vihiga',
            'employment_type'=>'formal',
            'email'=>'mdomulama@gmail.com',
            'password'=>$password,
            'image'=>'',
           'status'=>'1',],
           [
           'name'=>'Frank omulama',
           'mobile'=>'0705623820',
           'nationality'=>'Kenyan',
           'id_passport_number'=>'26332023',
           'county_city'=>'Vihiga',
           'employment_type'=>'formal',
           'email'=>'adomulama@gmail.com',
           'password'=>$password,
           'image'=>'',
          'status'=>'1',]
           
        ];
        Member::insert($memberrecords);
    }
}
