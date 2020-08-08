<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('brands')->delete();

        $admin_records = [
            ['id' => 1, 'name' => 'IFFCO INDIA', 'description' => 'IFFCO INDIA', 'slug' => 'iffco'],
            ['id' => 2, 'name' => 'National Fertilizers Limited', 'description' => 'National Fertilizers Limited', 'slug' => 'nfl'],
            ['id' => 3, 'name' => 'National Pesticides Limited', 'description' => 'National Pesticides Limited', 'slug' => 'national-pests-auth'],
            ['id' => 4, 'name' => 'Indo Farm LTD INDIA', 'description' => 'Indo Farm LTD INDIA', 'slug' => 'indo-farma'],
        ];

        //DB::table('admins')->insert($admin_records);

        foreach($admin_records as $key => $value){
            \App\Brand::create($value);
        }
    }
}
