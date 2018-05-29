<?php

use Illuminate\Database\Seeder;

class UserDevSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @param int $totalUsers
     * @param int $usersPerRole
     * @param int $roleID
     *
     * @return void
     * @throws Exception
     */
    public function run(int $totalUsers = 0, int $usersPerRole = 0, int $roleID = 0)
    {
        if($totalUsers || $usersPerRole) {
            $usersCreated = 0;

            $roles = \App\Models\UserGroup::all();
            if (!$roles->count()) {
                Throw new Exception("No users created. You need at least 1 user role to proceed!");
            }

            if($usersPerRole) {
                foreach ($roles as $role) {
                    $this->command->comment("Creating users with '".$role->name."' role");
                    $usersCreated++;
                    $this->createUser($usersPerRole, $role->groupID);
                }
            }else{
                $usersCreated = $totalUsers;
                $this->createUser($totalUsers, $roleID);
            }

            $this->command->info("Users created (" . ($usersCreated) . ")");
        }else{
            $this->command->error("Please give a total number of users you would like to create!");
        }
        return;
    }

    /**
     * Create user
     *
     * @param int $totalUsers
     * @param int $roleID If not roleID given, a random role will be chosen
     * @return mixed
     * @throws Exception
     */
    public function createUser(int $totalUsers = 1, int $roleID = 0){
        if(!$roleID){
            $roleID = \App\Models\UserGroup::getEditorGroup()->groupID;
        }

        $users = factory(App\Models\User::class, $totalUsers)->create();

        // assign role
        if($users) {
            foreach($users as $user){
                $user->assignRoles($roleID, true);
            }
        }else{
            throw new Exception("Something went wrong!");
        }
    }
}
