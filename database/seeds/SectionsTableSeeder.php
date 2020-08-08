<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('sections')->delete();

        $admin_records = [
            ['id' => 1, 'name' => 'Seeds', 'description' => 'Seeds'],
            ['id' => 2, 'name' => 'Fertilizers', 'description' => 'Fertilizers'],
            ['id' => 3, 'name' => 'Pesticides', 'description' => 'Pesticides'],
            ['id' => 4, 'name' => 'Machinery', 'description' => 'Machinery'],
        ];

        //DB::table('admins')->insert($admin_records);

        foreach($admin_records as $key => $value){
            \App\Section::create($value);
        }
    }
}
