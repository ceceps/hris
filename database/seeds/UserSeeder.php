<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(User::class, 20)->create();
        foreach(Spatie\Permission\Models\Role::all() as $role) {
            $users = factory(User::class, 20)->create();
            foreach($users as $user){
               $user->assignRole($role);
            }
         }
    }
}
