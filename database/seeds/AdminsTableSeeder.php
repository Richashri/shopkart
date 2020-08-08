<?php

use Illuminate\Database\Seeder;


class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        $admin_records = [
            ['id' => 1, 'name' => 'admin', 'type' => 'admin', 'mobile' => '7011010100', 'email' => 'admin@admin.com', 'password' => '$2y$10$ai49wpSZIILe7acfGiDLR.NGQT93jBVURUVcweYf8cSwze2v29F7m']
        ];

        DB::table('admins')->insert($admin_records);

        // foreach($admin_records as $key => $value){
        //     \App\Admin::create($value);
        // }
    }
}
