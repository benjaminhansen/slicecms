<?php

use Illuminate\Database\Seeder;
use DB;

class InsertPermissions extends Seeder
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
                "name" => "Network Administrator",
                "uri" => "network-administrator",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Site Administrator",
                "uri" => "site-administrator",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Site Editor",
                "uri" => "site-editor",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Site Contributor",
                "uri" => "site-contributor",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Site Subscriber",
                "uri" => "site-subscriber",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ];

        DB::table('permissions')->insert($permissions);
    }
}
