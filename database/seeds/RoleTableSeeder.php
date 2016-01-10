<?php

use App\Role;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class RoleTableSeeder extends Seeder {

    /**
     *
     */
    public function run()
    {
        Role::truncate();
        $data = [
            ["name" => "Admin"],
            ["name" => "Customer"],
        ];
        Role::insert($data);
    }
}