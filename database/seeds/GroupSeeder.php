<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'name'              => 'Group1',
            'manager_id'        => '2',
            'created_by'        => '1',
            'updated_by'        => '1',
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
        DB::table('groups')->insert([
            'name'              => 'Group2',
            'manager_id'        => '3',
            'created_by'        => '1',
            'updated_by'        => '1',
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
    }
}
