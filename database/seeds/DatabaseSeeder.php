<?php

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    private $tables  =  [
        'users',
        'categories'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        // \Eloquent::unguard();
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
    }

    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
