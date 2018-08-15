<?php

use Illuminate\Database\Seeder;
use DB;

class InsertSliceTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                "name" => "Page",
                "uri" => "page",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "News Post",
                "uri" => "news-post",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ];

        DB::table('content_slice_types')->insert($permissions);
    }
}
