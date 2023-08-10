<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CmsPage;


class CmsPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cmsPageRecords = [
            ['id'=>'1','title'=>'About us','description'=>'Content is coming soon','url'=>'aboutus','meta-title'=>'about us','meta-description'=>'about us','meta-keywords'=>'about us, about','status'=>'1'],
            ['id'=>'2','title'=>'Terms & conditions','description'=>'Content is coming soon','url'=>'terms-conditions','meta-title'=>'Terms & conditions','meta-description'=>'Terms & conditions','meta-keywords'=>'Terms & conditions','status'=>'1'],
            ['id'=>'3','title'=>'Privacy Policy','description'=>'Content is coming soon','url'=>'privacy-policy','meta-title'=>'privacy policy','meta-description'=>'Privacy policy','meta-keywords'=>'privacy, about','status'=>'1'],
        ];

        CmsPage::insert($cmsPageRecords);
    }
}
