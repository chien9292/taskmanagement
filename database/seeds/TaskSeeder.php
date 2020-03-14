<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'name'              => 'Upgrade LMS to get higher performance',
            'description'       => '- Delete old system\n- Build new system',
            'created_by'        => '2',
            'updated_by'        => '2'
        ]);

        DB::table('tasks')->insert([
            'name'              => 'Upgrade FAP to get higher performance',
            'description'       => '- Delete old system\n- Build new system',
            'created_by'        => '3',
            'updated_by'        => '3'
        ]);
    }
}
