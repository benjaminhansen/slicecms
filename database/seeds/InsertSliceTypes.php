<?php

use Illuminate\Database\Seeder;

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
                "deletable" => 0,
                "slice_function" => "page",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "News Post",
                "uri" => "news",
                "deletable" => 0,
                "slice_function" => "news",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ];

        DB::table('content_slice_types')->insert($permissions);
    }
}
