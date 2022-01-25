<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = DB::table('content')->count();

        // Add default data if empty
        if ($count == 0) {
            DB::table('content')->insert([
                ['priority'=>1,'title'=>'', 'colour'=>'#ffffff'],
                ['priority'=>2,'title'=>'Dropee.com', 'colour'=>'#ffffff'],
                ['priority'=>3,'title'=>'', 'colour'=>'#ffffff'],
                ['priority'=>4,'title'=>'Build Trust', 'colour'=>'#ffffff'],
                ['priority'=>5,'title'=>'', 'colour'=>'#ffffff'],
                ['priority'=>6,'title'=>'', 'colour'=>'#ffffff'],
                ['priority'=>7,'title'=>'SaaS enabled marketplace', 'colour'=>'#ffffff'],
                ['priority'=>8,'title'=>'', 'colour'=>'#ffffff'],
                ['priority'=>9,'title'=>'B2B Marketplace', 'colour'=>'#ffffff'],
                ['priority'=>10,'title'=>'', 'colour'=>'#ffffff'],
                ['priority'=>11,'title'=>'', 'colour'=>'#ffffff'],
                ['priority'=>12,'title'=>'', 'colour'=>'#ffffff'],
                ['priority'=>13,'title'=>'', 'colour'=>'#ffffff'],
                ['priority'=>14,'title'=>'', 'colour'=>'#ffffff'],
                ['priority'=>15,'title'=>'', 'colour'=>'#ffffff'],
                ['priority'=>16,'title'=>'Provide Transparency', 'colour'=>'#ffffff']
            ]);
        }
    }
}
