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
        $types = [
            [
                "name" => "Page",
                "uri" => "page",
                "deletable" => 0,
                "slice_function" => "page",
                "date_dependent" => 0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "News Post",
                "uri" => "news",
                "deletable" => 0,
                "slice_function" => "news",
                "date_dependent" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
        ];

        DB::table('content_slice_types')->insert($types);
    }
}
