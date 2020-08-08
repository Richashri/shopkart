<?php

use Illuminate\Database\Seeder;

class CategoryTablerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->delete();

        $admin_records = [
            ['id' => 1, 'name' => 'Pesticides Liquid', 'section_id' => 3, 'slug' => 'pesticides-liquid', 'description' => 'Pesticides Liquid', 'meta_keywords' => 'Pesticides Liquid', 'meta_description' => 'Pesticides Liquid'],
            ['id' => 2, 'name' => 'Fertilizers Liquid', 'section_id' => 2, 'slug' => 'fertilizers-liquid', 'description' => 'Fertilizers Liquid', 'meta_keywords' => 'Fertilizers Liquid', 'meta_description' => 'Fertilizers Liquid'],
            ['id' => 3, 'name' => 'Orangic Seeds', 'section_id' => 1, 'slug' => 'orangic-seeds', 'description' => 'Orangic Seeds', 'meta_keywords' => 'Orangic Seeds', 'meta_description' => 'Orangic Seeds'],
            ['id' => 4, 'name' => 'Hybrid Seeds', 'section_id' => 1, 'slug' => 'hybrid-seeds', 'description' => 'Hybrid Seeds', 'meta_keywords' => 'Hybrid Seeds', 'meta_description' => 'Hybrid Seeds'],
        ];

        //DB::table('admins')->insert($admin_records);

        foreach($admin_records as $key => $value){
            \App\Category::create($value);
        }
    }
}
