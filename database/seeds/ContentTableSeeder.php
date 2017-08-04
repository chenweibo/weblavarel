<?php

use Illuminate\Database\Seeder;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 30; $i++) {
            DB::table('content')->insert([
         'name' => $i,
         'rewrite' => str_random(10),
         'recommend' => 0,
         'lang'=>'cn',
         'type'=>2,
         'show'=>1,
     ]);
        }
    }
}
