<?php

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_roles')->truncate();

        $arrRoleUsers = [
            [

                'user_id' => 1,
                'role_id' => ROLE_ADMIN,

            ]
        ];

        \DB::table('user_roles')->insert($arrRoleUsers);
    }
}
